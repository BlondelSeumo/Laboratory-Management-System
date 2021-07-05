<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReportSettingRequest extends FormRequest
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
            'margin-top'=>'required|numeric',
            'margin-right'=>'required|numeric',
            'margin-bottom'=>'required|numeric',
            'margin-left'=>'required|numeric',
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
            'margin-top'=>'margin top',
            'margin-right'=>'margin right',
            'margin-bottom'=>'margin bottom',
            'margin-left'=>'margin left',

            'branch_name.color'=>'required',
            'branch_name.font-size'=>'required|min:1',
            'branch_name.font-family'=>'required',

            'branch_info.color'=>'required',
            'branch_info.font-size'=>'required|min:1',
            'branch_info.font-family'=>'required',

            'patient_title.color'=>'required',
            'patient_title.font-size'=>'required|min:1',
            'patient_title.font-family'=>'required',

            'patient_data.color'=>'required',
            'patient_data.font-size'=>'required|min:1',
            'patient_data.font-family'=>'required',

            'test_title.color'=>'required',
            'test_title.font-size'=>'required|min:1',
            'test_title.font-family'=>'required',

            'test_name.color'=>'required',
            'test_name.font-size'=>'required|min:1',
            'test_name.font-family'=>'required',

            'test_head.color'=>'required',
            'test_head.font-size'=>'required|min:1',
            'test_head.font-family'=>'required',

            'result.color'=>'required',
            'result.font-size'=>'required|min:1',
            'result.font-family'=>'required',


            'reference_range.color'=>'required',
            'reference_range.font-size'=>'required|min:1',
            'reference_range.font-family'=>'required',

            'status.color'=>'required',
            'status.font-size'=>'required|min:1',
            'status.font-family'=>'required',

            'comment.color'=>'required',
            'comment.font-size'=>'required|min:1',
            'comment.font-family'=>'required',

            'signature.color'=>'required',
            'signature.font-size'=>'required|min:1',
            'signature.font-family'=>'required',

            'antibiotic_name.color'=>'required',
            'antibiotic_name.font-size'=>'required|min:1',
            'antibiotic_name.font-family'=>'required',

            'sensitivity.color'=>'required',
            'sensitivity.font-size'=>'required|min:1',
            'sensitivity.font-family'=>'required',

            'commercial_name.color'=>'required',
            'commercial_name.font-size'=>'required|min:1',
            'commercial_name.font-family'=>'required',

            'report_footer.color'=>'required',
            'report_footer.font-size'=>'required|min:1',
            'report_footer.font-family'=>'required',
        ];
    }
}
