<?php

namespace App\DTOs\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UpdateCategoryDto
{
    public function __construct(
        public string $name,
        public ?string $description,
        public ?string $parentId,
        public ?UploadedFile $banner,
        public bool $displayInHome,
    ) {}

    /**
     * Map request to UpdateCategoryDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->name, 
            $request->description,
            $request->parent_id,
            $request->banner,
            $request->display_in_home ? true : false,
        );
    }
}
