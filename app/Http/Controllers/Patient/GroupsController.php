<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Requests\Patient\GroupOwnerRequest;
use DataTables;

class GroupsController extends Controller
{
    //dashboard
    public function index()
    {
        return view('patient.groups.index');
    }

    //ajax
    public function ajax(Request $request)
    {
        $model=Group::with('patient')->where('patient_id',auth()->guard('patient')->user()['id']);

        
        if($request['filter_status']!=null)
        {
            $model->where('done',$request['filter_status']);
        }
        
        return DataTables::eloquent($model)
        ->editColumn('subtotal',function($group){
            return formated_price($group['subtotal']);
        })
        ->editColumn('discount',function($group){
            return formated_price($group['discount']);
        })
        ->editColumn('total',function($group){
            return formated_price($group['total']);
        })
        ->editColumn('paid',function($group){
            return formated_price($group['paid']);
        })
        ->editColumn('due',function($group){
            return formated_price($group['due']);
        })
        ->editColumn('done',function($group){
            return view('patient.groups._status',compact('group'));
        })
        ->addColumn('action',function($group){
            return view('patient.groups._action',compact('group'));
        })
        ->toJson();
    }
    
    //show reports
    public function reports(GroupOwnerRequest $request,$id)
    {
        $group=Group::find($id);
        return view('patient.groups.reports',compact('group'));
    }
    
    //generate receipt
    public function receipt(GroupOwnerRequest $request,$id)
    {
        $group=Group::with('patient')->where('id',$id)->first();

        if(!empty($group['receipt_pdf']))
        {
            return redirect($group['receipt_pdf']);
        }
        else{
            session()->flash('failed',__('Something Went Wrong'));
            return redirect()->back();
        }
    }

    public function pdf(GroupOwnerRequest $request,$id)
    {
        //reports settings
        $reports_settings=setting('reports');

        //info setting
        $info_settings=setting('info');

        if(empty($request['analysis']))
        {
            $request['analysis']=[-1];
        }
        if(empty($request['culture']))
        {
            $request['culture']=[-1];
        }
        //find group
        $group=Group::with([
            'analyses'=>function($q)use($request){
               return $q->whereIn('id',$request['analysis']);
            },
            'cultures'=>function($q)use($request){
                return $q->whereIn('id',$request['culture']);
            },
        ])->where('id',$id)->firstOrFail();
        
        $pdf=generate_group_pdf($group);
       
        if(!empty($pdf))
        {
            return redirect($pdf);
        }
        else{
            session()->flash('failed',__('Something Went Wrong'));
            return redirect()->back();
        }

    }


}
