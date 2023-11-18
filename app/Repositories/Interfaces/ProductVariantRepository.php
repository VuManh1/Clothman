<?php

namespace App\Repositories\Interfaces;

use App\Models\ProductVariant;
use App\Repositories\Interfaces\Repository;

/**
 * Repository for product variant entity
 */
interface ProductVariantRepository extends Repository
{
    /**
     * Get one Product Variant by it detail
     */
    public function findByDetail(string $productId, string $colorId, string $size): ?ProductVariant;

    /**
     * Check if a product variant have at least one order
     * @param string $id (id of product variant to check)
     */
    public function checkHaveOrder(string $id): bool;
}
