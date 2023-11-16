<?php

namespace App\Repositories\Implementations;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepository;
use Illuminate\Support\Collection;

class EloquentCartRepository extends EloquentRepository implements CartRepository
{
    public function __construct() {
        parent::__construct(Cart::class);
    }

    public function getAllByUserId(string $userId): Collection {
        return $this->model->with([
            'user', 'product', 'productVariant.color'
        ])->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }

    public function findByDetail(string $productId, string $productVariantId, string $userId): ?Cart {
        return $this->model
               ->where('product_id', $productId)
               ->where('product_variant_id', $productVariantId)
               ->where('user_id', $userId)
               ->first();
    }
}
