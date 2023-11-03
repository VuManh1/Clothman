<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'phonenumber.required' => 'Số điện thoại không được để trống',
            'phonenumber.regex' => "Số điện thoại không hợp lệ"
        ];
    }
}
