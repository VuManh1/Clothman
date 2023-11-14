<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Products\ProductParamsDto;
use App\Models\Product;
use App\Repositories\Interfaces\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Repository for product entity
 */
interface ProductRepository extends Repository
{
    /**
     * Find one product by slug
     */
    public function findBySlug(string $slug, array $includes = null): ?Product;

    /**
     * Get products by ProductParamsDto
     */
    public function getProductsByParams(ProductParamsDto $paramms): LengthAwarePaginator;
    
    /**
     * Check if a product have at least one order
     * @param string $id (id of product to check)
     */
    public function checkHaveOrder(string $id): bool;

    /**
     * Get products order by updated at desc
     * 
     * @param int $count  (number of products)
     */
    public function getProductsOrderByUpdatedAtDesc(int $count): Collection;

    /**
     * Get products order by sold count
     * 
     * @param int $count  (number of products)
     */
    public function getProductsOrderBySoldDesc(int $count): Collection;
}
