<?php

namespace App\DTOs\Products;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class CreateProductDto
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
        public array $colors,
        public ?array $colorSizes,
        public array $colorQuantity,
        public array $colorSizeQuantity,
        public ?array $colorImages,
    ) {}

    /**
     * Map request to CreateProductDto object
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
            $request->colors,
            $request->color_sizes,
            $request->color_quantity,
            $request->color_size_quantity,
            $request->color_images,
        );
    }
}
