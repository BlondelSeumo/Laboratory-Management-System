<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingRequest extends FormRequest
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
            'name'=>'required',
            'currency'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'website'=>'required',
            'footer'=>'required',
            'reports_logo'=>'mimes:png|dimensions:max_width=100,max_height=100',
            'logo'=>'mimes:png|dimensions:max_width=100,max_height=100',
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
            'name' => 'Website name',
        ];
    }
}
