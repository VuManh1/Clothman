<?php

namespace App\DTOs\Banners;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class CreateBannerDto
{
    public function __construct(
        public string $name,
        public ?string $link,
        public UploadedFile $image,
    ) {}

    /**
     * Map request to CreateBannerDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->name,
            $request->link,
            $request->image,
        );
    }
}
