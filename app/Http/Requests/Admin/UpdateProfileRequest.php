<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'=>'required|unique:users,name,'.auth()->guard('admin')->user()->id,
            'email'=>'required|unique:users,email,'.auth()->guard('admin')->user()->id,
            'password'=>'confirmed',
            'signature'=>'nullable|mimes:jpg,bmp,png'
        ];
    }
}
