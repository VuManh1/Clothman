<?php

namespace App\DTOs\Colors;

use Illuminate\Http\Request;

class CreateColorDto
{
    public $name;
    public $hex_code;
    public function __construct(string $name, string $hex_code) {
        $this->name = $name;
        $this->hex_code = $hex_code;
    }

    // public static function fromRequest(Request $request) {
    //     return new self($request->name, $request->hex_code);
    // }

    public static function fromRequest(Request $request) {
        $name = $request->input('name');
        $hex_code = $request->input('hex_code');

        return new self($name, $hex_code);
    }
}
