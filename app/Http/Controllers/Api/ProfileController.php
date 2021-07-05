<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Response;
use Illuminate\Validation\Rule;
use App\Models\Patient;
use App\Models\Group;

class ProfileController extends Controller
{
    public function dashboard(Request $request)
    {
        $groups=Group::where('patient_id',$request->user()->id)->count();
        $pending_groups=Group::where('patient_id',$request->user()->id)->where('done',0)->count();
        $completed_groups=Group::where('patient_id',$request->user()->id)->where('done',1)->count();

        return Response::response(200,'success',[
            'groups'=>$groups,
            'pending_groups'=>$pending_groups,
            'completed_groups'=>$completed_groups
        ]);

    }

    public function update_profile(Request $request)
    {        
        $validation=Response::validation($request,[
            'name'=>'required',
            'gender'=>[
                'required',
                Rule::in(['male','female']),
            ],
            'dob'=>'required|date_format:d-m-Y',
            'phone'=>'required',
            'email'=>'required|email',
            'address'=>'required'
        ]);

        if(!empty($validation))
        {
            return $validation;
        }

        Patient::where('id',$request->user()->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'dob'=>$request->dob,
        ]);

        $patient=Patient::where('id',$request->user()->id)->first();

        return Response::response(200,'success',['patient'=>$patient]);
    }

   



}
