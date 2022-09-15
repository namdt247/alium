<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
//            'txtEmail' => 'required',
            'txtPhone' => 'required',
            'txtPassword' => 'required|confirmed|min:8'
        ];
    }

    public function messages()
    {
        return [
//            'txtEmail.required' => 'Địa chỉ email không được để trống',
            'txtPhone.required' => 'Số điện thoại không được để trống',
            'txtPassword.required' => 'Mật khẩu không được để trống',
            'txtPassword.min' => 'Mật khẩu tối thiểu 8 kí tự',
            'txtPassword.confirmed' => 'Xác nhận mật khẩu không khớp',
            'txtPassword_confirmation.required' => 'Nhập lại mật khẩu',
            'txtPassword_confirmation.min' => 'Mật khẩu tối thiểu 8 kí tự',
        ];
    }
}
