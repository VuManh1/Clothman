<?php

namespace App\Repositories\Implementations;

use App\Models\ProductVariant;
use App\Repositories\Interfaces\ProductVariantRepository;

class EloquentProductVariantRepository extends EloquentRepository implements ProductVariantRepository
{
    public function __construct() {
        parent::__construct(ProductVariant::class);
    }

    public function findByDetail(string $productId, string $colorId, string $size): ?ProductVariant {
        return $this->model
               ->where('product_id', $productId)
               ->where('color_id', $colorId)
               ->where('size', $size)
               ->first();
    }
}
