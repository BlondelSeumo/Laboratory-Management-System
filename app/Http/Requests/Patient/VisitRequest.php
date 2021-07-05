<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class VisitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if($request['patient_type']==1)
        {
            return [
                'name'=>'required|unique:patients',
                'phone'=>'required|unique:patients',
                'email'=>'required|email|unique:patients',
                'gender'=>[
                    'required',
                    Rule::in(['male','female']),
                ],
                'address'=>'required',
                'dob'=>'required|date_format:d-m-Y',
                'visit_date'=>'required|date_format:d-m-Y',
                'lat'=>'required',
                'lng'=>'required',
                'attach'=>'image'
            ];
        }
        else{
            return [
                'visit_date'=>'required|date_format:d-m-Y',
                'lat'=>'required',
                'lng'=>'required',
                'attach'=>'image'
            ];
        }
        
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'dob'=>'date of birth',
            'lat'=>'location on map',
            'lng'=>'location on map',
        ];
    }
}
