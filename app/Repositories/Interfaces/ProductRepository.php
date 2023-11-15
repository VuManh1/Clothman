<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Products\ProductParamsDto;
use App\DTOs\Products\SearchProductsDto;
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
     * Find products by category slug
     */
    public function findByCategorySlug(string $slug, int $page, int $limit): LengthAwarePaginator;

    /**
     * Find products by ProductParamsDto
     */
    public function findByParams(ProductParamsDto $params): LengthAwarePaginator;
    
    /**
     * Check if a product have at least one order
     * @param string $id (id of product to check)
     */
    public function checkHaveOrder(string $id): bool;

    /**
     * Get products order by a column
     * 
     * @param string $column  (column to order)
     * @param string $order  (asc, desc)
     * @param int $count  (number of products)
     */
    public function getProductsOrderBy(string $column, string $order, int $count): Collection;

    /**
     * Search for products
     */
    public function searchProducts(SearchProductsDto $params): LengthAwarePaginator;

    /**
     * Get products which have discount greater than 0
     */
    public function getDiscountProducts(int $page, int $limit, string $order = "desc"): LengthAwarePaginator;
}
