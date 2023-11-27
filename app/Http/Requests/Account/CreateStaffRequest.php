<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class CreateStaffRequest extends FormRequest
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
            'email'=> 'required',
            'password'=> 'required',
            'phone_number'=> 'required',
        ];
    }

    /**
     * Get the error messages for the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'Người chứ có phải * đâu mà không có tên',
            'email.required' => 'Nhập email đê e ơi!',
            'password.required' => 'Không mật khẩu, khỏi đăng nhập',
            'phone_number.required'=> 'bắt buộc',
        ];
    }
}
