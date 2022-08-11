<?php

namespace App\Http\Requests;

use App\Rules\Captcha;
use Illuminate\Foundation\Http\FormRequest;

class PublicRegisterRequest extends FormRequest
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
            'account_name' => 'required|min:6',
                'account_email' => 'required|min:6|email|unique:tbl_account,account_email',
                'account_phone' => 'required|numeric|digits:10',
                'account_password' => 'required|min:6',
                'account_cfpassword' => 'required|same:account_password',
                'g-recaptcha-response' => new Captcha(),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'account_email.unique' => 'This email has already been taken'
        ];
    }
}
