<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WhatsappSettingRequest extends FormRequest
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
            'receipt.message'=>'regex:/{patient_name}/|regex:/{receipt_link}/',
            'report.message'=>'regex:/{patient_name}/|regex:/{report_link}/'
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
            'receipt.message' => 'Receipt message',
            'report.message' => 'Report message',
        ];
    }
}
