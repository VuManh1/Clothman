<?php

namespace App\Repositories\Implementations;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepository;

class EloquentProductRepository extends EloquentRepository implements ProductRepository
{
    public function __construct() {
        parent::__construct(Product::class);
    }

    public function get() {

    }
}
