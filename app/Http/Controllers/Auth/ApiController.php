<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Mail\PatientCode;
use App\Http\Controllers\Api\Response;
use Illuminate\Validation\Rule;
use Mail;
use Validator;
use Str;

class ApiController extends Controller
{
    public $code='';
    public $message='';
    public $body='';

    public function login(Request $request)
    {
        
        $validation=Response::validation($request,['code'=>'required']);//validations

        if(!empty($validation))
        {
            return $validation;
        }
        
        $patient=Patient::where('code',$request['code'])->first();

        if(isset($patient))
        {
            $this->code=200;
            $this->message='success';
            $this->body=$patient;

            //create patient token
            $token = $patient->createToken('Laravel Password Grant Client')->accessToken;
            $patient['api_token']=$token;
            
            return Response::response($this->code,$this->message,$this->body);

        }
        else{

            $this->code=400;
            $this->message='patient not found';

            return Response::response($this->code,$this->message,$this->body);

        }
       
    }


    public function forget_code(Request $request)
    {
        $validation=Response::validation($request,['email'=>'required|email']);

        if(!empty($validation))
        {
            return $validation;
        }

        $patient=Patient::where('email',$request['email'])->first();

        if(!empty($patient))
        {
            //send mail patient code
            send_notification('patient_code',$patient);

            $this->code=200;
            $this->message='mail sent successfully';

            return Response::response($this->code,$this->message,$this->body);
        }
        else{
            $this->code=400;
            $this->message='patient email not found';
            
            return Response::response($this->code,$this->message,$this->body);
        }


    }

    public function register(Request $request)
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
        
        //register patient
        $patient=Patient::create([
            'code'=>patient_doctor(),
            'name'=>$request['name'],
            'phone'=>$request['phone'],
            'email'=>$request['email'],
            'gender'=>$request['gender'],
            'dob'=>$request['dob'],
            'address'=>$request['address'],
        ]);

        //create token
        $token = $patient->createToken('Laravel Password Grant Client')->accessToken;
        $patient['api_token']=$token;

        //response
        $this->code=200;
        $this->message='success';
        $this->body=['patient'=>$patient];

        send_notification('patient_code',$patient);

        return Response::response($this->code,$this->message,$this->body);

    }

   
}
