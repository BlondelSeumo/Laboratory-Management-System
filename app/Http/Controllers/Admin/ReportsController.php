<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Test;
use App\Models\GroupTest;
use App\Models\GroupCulture;
use App\Models\GroupTestResult;
use App\Models\GroupCultureResult;
use App\Models\GroupCultureOption;
use App\Models\Antibiotic;
use App\Models\Setting;
use App\Models\Patient;
use App\Models\TestOption;
use App\Http\Requests\Admin\UpdateCultureResultRequest;
use App;
use DataTables;
class ReportsController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_report',     ['only' => ['index', 'show']]);
        $this->middleware('can:create_report',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_report',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_report',   ['only' => ['destroy']]);
        $this->middleware('can:sign_report',   ['only' => ['sign']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    /**
    * get groups datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=Group::query()->with('patient','tests','cultures')->orderBy('id','desc');

        if($request['filter_status']!=null)
        {
            $model->where('done',$request['filter_status']);
        }
        
        if($request['filter_barcode']!=null)
        {
            $model->where('barcode',$request['filter_barcode']);
        }

        if($request['filter_date']!=null)
        {
            //format date
            $date=explode('-',$request['filter_date']);
            $from=date('Y-m-d',strtotime($date[0]));
            $to=date('Y-m-d 23:59:59',strtotime($date[1]));

            //select groups of date between
            ($from==$to)?$mode->whereDate('created_at',$from):$model->whereBetween('created_at',[$from,$to]);
        }
        
        return DataTables::eloquent($model)
        ->editColumn('patient.gender',function($group){
            return __(ucwords($group['patient']['gender']));
        })
        ->editColumn('tests',function($group){
            return view('admin.reports._tests',compact('group'));
        })
        ->addColumn('signed',function($group){
            return view('admin.reports._signed',compact('group'));
        })
        ->editColumn('done',function($group){
            return view('admin.reports._status',compact('group'));
        })
        ->addColumn('action',function($group){
            return view('admin.reports._action',compact('group'));
        })
        ->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group=Group::findOrFail($id);

        return view('admin.reports.show',compact('group'));
    }

    /**
     * Generate report pdf
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf(Request $request,$id)
    {
        //set null if no analysis or cultures selected
        if(empty($request['tests']))
        {
            $request['tests']=[-1];
        }
        if(empty($request['cultures']))
        {
            $request['cultures']=[-1];
        }

        //find group
        $group=Group::with([
            'tests'=>function($q)use($request){
               return $q->whereIn('id',$request['tests']);
            },
            'cultures'=>function($q)use($request){
                return $q->whereIn('id',$request['cultures']);
            },
        ])->where('id',$id)->first();

        //generate pdf
        $pdf=generate_pdf($group);

        if(isset($pdf))
        {
            return redirect($pdf);
        }
        else{
            session()->flash('failed',__('Something Went Wrong'));
            return redirect()->back();
        }
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group=Group::with(['tests'=>function($q){
          return $q->with('test.components');
        },'cultures'])->where('id',$id)->firstOrFail();

        $select_antibiotics=Antibiotic::all();

        return view('admin.reports.edit',compact('group','select_antibiotics'));
    }

    /**
     * Update analysis report
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group_test=GroupTest::where('id',$id)->firstOrFail();
        
        GroupTest::where('id',$id)->update([
           'done'=>true,
           'comment'=>$request['comment']
        ]);

        $group=Group::find($group_test['group_id']);
        
        //check if all reports done
        $done=check_group_done($group_test['group_id']);

        //send tests notification
        if($done)
        {
            $patient=Patient::find($group['patient_id']);
            send_notification('tests_notification',$patient);
        }

        //end check

        $group->update(['done'=>$done]);

        //update result
        if($request->has('result'))
        {
            foreach($request['result'] as $key=>$result)
            {
                $group_test_result=GroupTestResult::where('id',$key)->first();

                $test=Test::where('id',$group_test_result['test_id'])->first();

                //add if new option created
                if(isset($test)&&$test['type']=='select')
                {
                    $option=TestOption::where([
                        ['test_id',$test['id']],
                        ['name',$result['result']]
                    ])->first();

                    if(!isset($option))
                    {
                        TestOption::create([
                            'name'=>$result['result'],
                            'test_id'=>$test['id']
                        ]);
                    }
                }

                if(!isset($result['status']))
                {
                    $result['status']='';
                }

                if(!isset($result['result']))
                {
                    $result['result']='';
                }
                
                //update result
                $group_test_result->update([
                    'result'=>$result['result'],
                    'status'=>$result['status']
                ]);
            }
        }

        //generate pdf
        $pdf=generate_pdf($group);

        if(isset($pdf))
        {
            $group->update(['report_pdf'=>$pdf]);
        }
      
        session()->flash('success',__('Test result saved successfully'));

        return redirect()->back();
    }

    /**
     * Update culture report
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_culture(UpdateCultureResultRequest $request,$id)
    {        
        $group_culture=GroupCulture::findOrFail($id);        
      
        GroupCultureResult::where('group_culture_id',$id)->delete();

        $group_culture->update([
            'done'=>true,
            'comment'=>$request['comment']
        ]);

        //save options
        foreach($request['culture_options'] as $key=>$value)
        {
            GroupCultureOption::where('id',$key)->update([
                'value'=>$value
            ]);
        }
        
        //save antibiotics
        if($request->has('antibiotic'))
        {
            foreach($request['antibiotic'] as $antibiotic)
            {
                if(!empty($antibiotic['antibiotic'])&&!empty($antibiotic['sensitivity']))
                {
                    GroupCultureResult::create([
                        'group_culture_id'=>$id,
                        'antibiotic_id'=>$antibiotic['antibiotic'],
                        'sensitivity'=>$antibiotic['sensitivity'],
                    ]);
                }
            }
        }


        //check if all reports done
        $done=check_group_done($group_culture['group_id']);

        //send tests notification
        $group=Group::find($group_culture['group_id']);
        if($done)
        {
            $patient=Patient::find($group['patient_id']);
            send_notification('tests_notification',$patient);
        }

        //end check

        //generate pdf
        $pdf=generate_pdf($group);

        if(isset($pdf))
        {
            $group->update(['report_pdf'=>$pdf]);
        }

        session()->flash('success',__('Culture result saved successfully'));

        return redirect()->back();
       
    }

    /**
     * Sign report
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sign($id)
    {
        $group=Group::where('id',$id)->firstOrFail();

        //add signature
        $group->update([
            'signature'=>auth()->guard('admin')->user()->signature
        ]);

        //generate pdf
        $pdf=generate_pdf($group);

        if(isset($pdf))
        {
            $group->update(['report_pdf'=>$pdf]);
        }

        session()->flash('success',__('Report signed successfully'));
 
        return redirect()->route('admin.reports.index');
    }

    
}
