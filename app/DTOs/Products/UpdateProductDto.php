<?php

namespace App\DTOs\Products;

class UpdateProductDto
{
    public function __construct(
        public string $name
    ) {}
}
