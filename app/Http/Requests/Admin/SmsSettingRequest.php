<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SmsSettingRequest extends FormRequest
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
            'sid'=>'required',
            'token'=>'required',
            'from'=>'required',
            'patient_code.message'=>'regex:/{patient_code}/|regex:/{patient_name}/',
            'tests_notification.message'=>'regex:/{patient_code}/|regex:/{patient_name}/'
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
            'sid'=>'Twilio sid',
            'token'=>'Twilio token',
            'from' => 'Twilio from number',
            'patient_code.message' => 'Patient code sms message',
            'tests_notification.message' => 'Tests notification sms message',
        ];
    }
}
