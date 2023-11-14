<?php

namespace App\Services\Products\Interfaces;

use App\DTOs\Products\ProductParamsDto;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Service Interface for product to deal with Read operations
 */
interface GetProductsService
{
    /**
     * Get products
     */
    public function getProductsByParams(ProductParamsDto $params): LengthAwarePaginator;

    /**
     * Get one product by ID
     * @return \App\Models\Product
     * @throws \App\Exceptions\Products\ProductNotFoundException
     */
    public function getProductById(string $id, array $includes = null): Product;

    /**
     * Get one product by slug
     * @return \App\Models\Product
     * @throws \App\Exceptions\Products\ProductNotFoundException
     */
    public function getProductBySlug(string $slug, array $includes = null): Product;

    /**
     * Get latest products
     * 
     * @param int $count  (number of products)
     */
    public function getLatestProducts(int $count): Collection;

    /**
     * Get top sold products
     * 
     * @param int $count  (number of products)
     */
    public function getTopSoldProducts(int $count): Collection;
}
