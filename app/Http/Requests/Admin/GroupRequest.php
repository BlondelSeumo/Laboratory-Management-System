<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
    public function rules()
    {
        return [
            'branch_id'=>'required',
            'patient_id'=>'required',
            'subtotal'=>'required|numeric',
            'discount'=>'required|numeric',
            'total'=>'required|numeric',
            'paid'=>'required|numeric',
            'due'=>'required|numeric',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'branch_id'=>'branch',
            'patient_id'=>'patient',
            'doctor_id'=>'doctor',
        ];
    }
}
