<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Patient;
use App\Models\Group;
use App\Models\Test;
use App\Models\Culture;
use App\Models\Branch;
use App\Models\Contract;
use App\Http\Requests\Admin\VisitRequest;
use Str;
use DataTables;

class VisitsController extends Controller
{
     /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_visit',     ['only' => ['index', 'show','ajax']]);
        $this->middleware('can:create_visit',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_visit',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_visit',   ['only' => ['destroy']]);
        $this->middleware('can:create_group',   ['only' => ['create_tests']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.visits.index');
    }

     /**
    * get visits datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=Visit::with('patient')->orderBy('id','desc');

        if($request['filter_read']!=null)
        {
            $model->where('read',$request['filter_read']);
        }

        if($request['filter_status']!=null)
        {
            $model->where('status',$request['filter_status']);
        }
        
        return DataTables::eloquent($model)

        ->editColumn('read',function($visit){
            return view('admin.visits._read',compact('visit'));
        })
        ->editColumn('status',function($visit){
            return view('admin.visits._status',compact('visit'));
        })
        ->addColumn('action',function($visit){
            return view('admin.visits._action',compact('visit'));
        })
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.visits.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitRequest $request)
    {        

        if($request->has('patient_id'))
        {
            $patient=Patient::find($request['patient_id']);
        }
        else{
            $patient=Patient::create([
             'code'=>time(),
             'name'=>$request['name'],
             'phone'=>$request['phone'],
             'dob'=>$request['dob'],
             'address'=>$request['address'],
             'gender'=>$request['gender'],
             'email'=>$request['email'],
             'api_token'=>Str::random(32)
            ]);
        }

        $visit=Visit::create([
            'patient_id'=>$patient['id'],
            'lat'=>$request['lat'],
            'lng'=>$request['lng'],
            'zoom_level'=>$request['zoom_level'],
            'visit_date'=>$request['visit_date'],
        ]);

        if($request->has('attach'))
        {
            $attach=$request->file('attach');
            $name=time().'.'.$attach->getClientOriginalExtension();
            $attach->move('uploads/visits',$name);
            $visit->update(['attach'=>$name]);
        }

        session()->flash('success',__('Visit saved successfully'));
        
        return redirect()->route('admin.visits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visit=Visit::find($id);

        $visit->update(['read'=>true]);

        return view('admin.visits.show',compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visit=Visit::find($id);

        $visit->update(['read'=>true]);

        return view('admin.visits.edit',compact('visit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VisitRequest $request, $id)
    {
        $visit=Visit::findOrFail($id);
        $visit->update($request->except('_token','_method','patient_type'));

        if($request->has('attach'))
        {
            $attach=$request->file('attach');
            $name=time().'.'.$attach->getClientOriginalExtension();
            $attach->move('uploads/visits',$name);
            $visit=Visit::find($id);
            $visit->update(['attach'=>$name]);
        }

        session()->flash('success',__('Visit updated successfully'));

        return redirect()->route('admin.visits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visit=Visit::findOrFail($id);
        $visit->delete();

        session()->flash('success',__('Visit deleted successfully'));
        
        return redirect()->route('admin.visits.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function create_tests($visit_id)
    {
        $visit=Visit::find($visit_id);

        $visit->update([
            'read'=>true,
            'status'=>true,
        ]);

        $tests=Test::where('parent_id',0)->orWhere('separated',true)->get();
        $cultures=Culture::all();
        $branches=Branch::all();
        $contracts=Contract::all();

        return view('admin.groups.create',compact('visit','tests','cultures','branches','contracts'));
    }
}
