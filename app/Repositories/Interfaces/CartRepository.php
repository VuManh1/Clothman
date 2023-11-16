<?php

namespace App\Repositories\Interfaces;

use App\Models\Cart;
use Illuminate\Support\Collection;

/**
 * Repository for Cart entity
 */
interface CartRepository extends Repository
{
    /**
     * Get all carts by user ID
     */
    public function getAllByUserId(string $userId): Collection;

    /**
     * Get number of cart by User ID
     */
    public function getCountByUserId(string $userId): int;

    /**
     * Get one cart by it's detail
     */
    public function findByDetail(string $productId, string $productVariantId, string $userId): ?Cart;
}
