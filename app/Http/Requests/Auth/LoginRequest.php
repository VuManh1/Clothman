<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ];
    }

    /**
     * Get the messages for the error request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu không được để trống',
            'email.required' => 'Email không được để trống',
            'email' => 'Email không hợp lệ',
        ];
    }
}
