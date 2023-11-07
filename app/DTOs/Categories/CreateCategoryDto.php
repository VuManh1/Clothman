<?php

namespace App\DTOs\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class CreateCategoryDto
{
    public function __construct(
        public string $name,
        public ?string $description,
        public ?string $parentId,
        public ?UploadedFile $banner
    ) {}

    /**
     * Map request to CreateCategoryDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->name, 
            $request->description,
            $request->parent_id,
            $request->banner
        );
    }
}
