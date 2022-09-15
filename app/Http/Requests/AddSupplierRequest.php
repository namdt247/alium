<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSupplierRequest extends FormRequest
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
            'txtName' => 'required|min:6',
            'txtPhone' => 'required|unique:supplier,sp_phone|numeric',
//            'txtEmail' => 'required|unique:supplier,sp_email',
            'txtAddress' => 'required',
            'txtNumEmployee' => 'required|numeric',
            'txtMinQuantity' => 'required|numeric',
            'txtMaxQuantity' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'txtName.required' => 'Tên xưởng không được để trống',
            'txtName.min' => 'Tên xưởng tối thiểu 6 kí tự',
            'txtPhone.required' => 'Số điện thoại không được để trống',
            'txtPhone.unique' => 'Số dt đã được dùng để đăng ký tài khoản',
//            'txtEmail.required' => 'Địa chỉ email không được để trống',
//            'txtEmail.unique' => 'Địa chỉ email đã được dùng để đăng ký tài khoản',
            'txtAddress.required' => 'Địa chỉ xưởng không được để trống',
            'txtNumEmployee.required' => 'Số lượng nhân công không được để trống',
            'txtMinQuantity.required' => 'Số lượng nhận sx tối thiểu không được để trống',
            'txtMaxQuantity.required' => 'Số lượng nhận sx tối đa không được để trống',
        ];
    }
}
