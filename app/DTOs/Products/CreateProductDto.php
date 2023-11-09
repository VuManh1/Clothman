<?php

namespace App\DTOs\Products;

use Illuminate\Http\Request;

class CreateProductDto
{
    public function __construct(
        public string $name,
        public string $code,
        public string $categoryId,
        public ?string $description,
        public ?string $material,
        public ?int $price,
        public ?int $discount,
        public ?string $sizeGuildUrl,
        public ?int $quantity,
    ) {}

    /**
     * Map request to CreateProductDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->name, 
            $request->code,
            $request->categor_id,
            $request->description,
            $request->material,
            $request->price,
            $request->discount,
            $request->sizeGuildUrl,
            $request->quantity,
        );
    }
}
