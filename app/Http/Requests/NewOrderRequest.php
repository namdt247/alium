<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewOrderRequest extends FormRequest
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
            'sltUser' => 'required|numeric|min:1',
            'txtPhone' => 'required|numeric',
            'txtEmail' => 'required',
            'txtName' => 'required',
            'txtDate' => 'required',
            'sltCountry' => 'required|numeric|min:1',
//            'sltCity' => 'required|numeric|min:1',
//            'sltDistrict' => 'required|numeric|min:1',
            'sltProduct' => 'required|numeric|min:1',
            'sltQuality' => 'required|numeric|min:1',
            'sltRequire' => 'required',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
