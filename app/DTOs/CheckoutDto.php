<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class CheckoutDto
{
    public function __construct(
    ) {}

    /**
     * Map request to CheckoutDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
        );
    }
}
