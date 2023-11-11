<?php

namespace App\Repositories\Implementations;

use App\Exceptions\Products\ProductNotFoundException;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepository;

class EloquentProductRepository extends EloquentRepository implements ProductRepository
{
    public function __construct() {
        parent::__construct(Product::class);
    }

    public function checkHaveOrder(string $id): bool {
        $product = $this->findById($id);

        if (!$product) throw new ProductNotFoundException();

        return $product->orders()->exists();
    }
}
