<?php

namespace App\DTOs\Cart;

use Illuminate\Http\Request;

class AddToCartDto
{
    public function __construct(
        public string $productId,
        public string $colorId,
        public ?string $size,
        public int $quantity,
    ) {}

    /**
     * Map request to AddToCartDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->product_id,
            $request->color_id,
            $request->size,
            $request->quantity,
        );
    }
}
