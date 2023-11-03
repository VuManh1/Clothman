<?php

namespace App\DTOs\Categories;

use Illuminate\Http\Request;

class CreateCategoryDto
{
    public $name;
    public $description;
    public function __construct(string $name, string $description) {
        $this->name = $name;
        $this->description = $description;
    }

    public static function fromRequest(Request $request) {
        return new self($request->name, $request->description);
    }
}
