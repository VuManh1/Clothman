<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required|min:8',
            'password' => 'required|min:8',
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
            'old_password.required' => 'Mật khẩu cũ không được để trống',
            'old_password.min' => "Mật khẩu cũ không được ít hơn 8 ký tự",
            'password.required' => 'Mật khẩu mới không được để trống',
            'password.min' => "Mật khẩu mới không được ít hơn 8 ký tự",
        ];
    }
}
