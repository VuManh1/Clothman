<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class CheckoutDto
{
    public function __construct(
        public string $name,
        public string $phonenumber,
        public string $email,
        public string $address,
        public ?string $note,
        public string $paymentMethod
    ) {}

    /**
     * Map request to CheckoutDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->name,
            $request->phonenumber,
            $request->email,
            $request->address,
            $request->note,
            $request->payment_method,
        );
    }
}
