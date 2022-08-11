<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicLoginRequest extends FormRequest
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
            'account_email' => 'required|min:6|email|exists:tbl_account,account_email',
            'account_password' => 'required|min:6'
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
            'account_email.exists' => 'This email has not been register'
        ];
    }
}
