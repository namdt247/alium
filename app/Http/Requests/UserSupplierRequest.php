<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSupplierRequest extends FormRequest
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
            'txtEmail' => 'required',
            'txtPhone' => 'required',
            'txtShowName' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'txtEmail.required' => 'Địa chỉ email không được để trống',
            'txtPhone.required' => 'Số điện thoại không được để trống',
            'txtShowName.required' => 'Họ tên không được để trống',
        ];
    }
}
