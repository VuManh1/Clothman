<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'phonenumber' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8'
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
            'name.required' => 'Tên người dùng không được để trống',
            'email.required' => 'Email không được để trống',
            'phonenumber.required' => 'Số điện thoại không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => "Mật khẩu không được ít hơn 8 ký tự",
            'email.email' => "Email không hợp lệ",
            'phonenumber' => "Số điện thoại không hợp lệ"
        ];
    }
}
