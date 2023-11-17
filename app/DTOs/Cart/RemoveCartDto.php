<?php

namespace App\DTOs\Cart;

use Illuminate\Http\Request;

class RemoveCartDto
{
    public function __construct(
        public string $productId,
        public string $variantId,
    ) {}

    /**
     * Map request to RemoveCartDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->product_id,
            $request->variant_id,
        );
    }
}
