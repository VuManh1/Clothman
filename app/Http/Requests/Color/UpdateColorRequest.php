<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required',
            'hex_code'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'name' => 'Tên là bắt buộc',
            'hex_code' => 'Mã Màu là bắt buộc',
        ];
    }
}
