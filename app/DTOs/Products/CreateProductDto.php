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
        public int $price,
        public int $sellingPrice,
        public int $discount,
        public ?UploadedFile $thumbnail,
        public ?UploadedFile $sizeGuild,
        public ?array $variants,
        public ?array $colorImages,
    ) {
    }

    /**
     * Map request to CreateProductDto object
     */
    public static function fromRequest(Request $request)
    {
        $variants = [];
        $colorImages = [];

        foreach ($request->colors as $color) {
            if (isset($request->color_sizes) && isset($request->color_sizes[$color])) {
                $sizes = $request->color_sizes[$color];

                foreach ($sizes as $size) {
                    array_push($variants, [
                        'colorId' => $color,
                        'size' => $size,
                        'quantity' => $request->color_size_quantity[$color][$size],
                    ]);
                }
            } else {
                array_push($variants, [
                    'colorId' => $color,
                    'size' => null,
                    'quantity' => isset($request->color_quantity) && isset($request->color_quantity[$color]) ?
                        $request->color_quantity[$color] : 0
                ]);
            }

            if (isset($request->color_images) && isset($request->color_images[$color])) {
                $images = $request->color_images[$color];

                foreach ($images as $image) {
                    array_push($colorImages, [
                        'image' => $image,
                        'colorId' => $color
                    ]);
                }
            }
        }

        return new self(
            $request->name,
            $request->category_id,
            $request->description,
            $request->material,
            $request->price,
            $request->selling_price ?? 0,
            $request->discount ?? 0,
            $request->thumbnail,
            $request->size_guild,
            $variants,
            $colorImages
        );
    }
}
