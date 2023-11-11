<?php

namespace App\DTOs\Products;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UpdateProductDto
{
    public function __construct(
        public string $name,
        public string $categoryId,
        public ?string $description,
        public ?string $material,
        public ?int $price,
        public ?int $discount,
        public ?UploadedFile $thumbnail,
        public ?UploadedFile $sizeGuild,
    ) {}

    /**
     * Map request to UpdateProductDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->name, 
            $request->category_id,
            $request->description,
            $request->material,
            $request->price,
            $request->discount,
            $request->thumbnail,
            $request->size_guild,
        );
    }
}
