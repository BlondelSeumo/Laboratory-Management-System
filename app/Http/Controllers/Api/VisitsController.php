<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Response;
use App\Models\Visit;
use App\Models\Patient;
use Str;

class VisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('patient_id'))
        {
            $validation=Response::validation($request,[
                'name'=>'required',
                'phone'=>'required',
                'address'=>'required',
                'gender'=>'required',
                'dob'=>'required',
                'email'=>'required|email',
                'visit_date'=>'required',
                'lat'=>'required',
                'lng'=>'required',
            ]);
        }
      
        if(!empty($validation))
        {
            return $validation;
        }
        
        if(!empty($request['patient_id']))
        {
            $patient=Patient::find($request['patient_id']);

            if(empty($patient))
            {
                return Response::response(400,'error','unknown patient_id');
            }
        }
        else{
            $patient=Patient::create([
                'code'=>patient_code(),
                'name'=>$request['name'],
                'phone'=>$request['phone'],
                'dob'=>$request['dob'],
                'gender'=>$request['gender'],
                'address'=>$request['address'],
                'email'=>$request['email']
            ]);
        }
        
        //create patient visit
        $visit=Visit::create([
            'patient_id'=>$patient['id'],
            'lat'=>$request['lat'],
            'lng'=>$request['lng'],
            'visit_date'=>$request['visit_date'],
        ]);

        if($request->has('attach'))
        {
            //save file
            $data = explode( ',',$request['attach']);
            $extension=explode('/',mime_content_type($request['attach']))[1];
            $decoded = base64_decode($data[1]);
            //generte name
            $name=time().Str::random(4).'.'.$extension;
            file_put_contents("uploads/visits/".$name,$decoded);
            //save file name to record
            $visit->update(['attach'=>$name]);
        }

        return Response::response(200,'success',['visit'=>$visit]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
