<?php

namespace App\DTOs\Colors;

use Illuminate\Http\Request;

class UpdateColorDto
{
    public function __construct(
        public string $name,
        public string $hex_code
    ){}

    /**
     * Map request to UpdateColorDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->name,
            $request->hex_code
        );
    }
}
