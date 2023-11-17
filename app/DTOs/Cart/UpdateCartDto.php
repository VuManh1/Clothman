<?php

namespace App\DTOs\Cart;

use Illuminate\Http\Request;

class UpdateCartDto
{
    public function __construct(
        public string $productId,
        public string $variantId,
        public int $quantity,
    ) {}

    /**
     * Map request to UpdateCartDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->product_id,
            $request->variant_id,
            $request->quantity,
        );
    }
}
