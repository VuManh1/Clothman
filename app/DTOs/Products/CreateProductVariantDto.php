<?php

namespace App\DTOs\Products;

use Illuminate\Http\Request;

class CreateProductVariantDto
{
    public function __construct(
        public string $productId,
        public string $colorId,
        public string $size,
        public int $quantity,
    ) {
    }

    /**
     * Map request to CreateProductVariantDto object
     */
    public static function fromRequest(Request $request) {
        return new CreateProductVariantDto(
            $request->product_id,
            $request->color_id,
            $request->size,
            $request->quantity,
        );
    }
}
