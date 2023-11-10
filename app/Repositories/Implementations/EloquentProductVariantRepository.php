<?php

namespace App\Repositories\Implementations;

use App\Models\ProductVariant;
use App\Repositories\Interfaces\ProductVariantRepository;

class EloquentProductVariantRepository extends EloquentRepository implements ProductVariantRepository
{
    public function __construct() {
        parent::__construct(ProductVariant::class);
    }
}
