<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Products\ProductParamsDto;
use App\Repositories\Interfaces\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Repository for product entity
 */
interface ProductRepository extends Repository
{
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
     * Get latest products
     * 
     * @param int $count  (number of products)
     */
    public function getLatestProducts(int $count): Collection;
}
