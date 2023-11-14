<?php

namespace App\DTOs\Banners;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UpdateBannerDto {
    public function __construct(
        public string $name,
        public ?string $link,
        public ?UploadedFile $image,
        public bool $is_active,
    ){}

    public static function fromRequest(Request $request) {
        return new self(
            $request->name,
            $request->link,
            $request->image,
            $request->is_active ? true : false,
        );
    }
}
