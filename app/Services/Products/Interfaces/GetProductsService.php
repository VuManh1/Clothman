<?php

namespace App\Services\Products\Interfaces;

use App\DTOs\Products\ProductParamsDto;
use App\DTOs\Products\SearchProductsDto;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Service Interface for product to deal with Read operations
 */
interface GetProductsService
{
    /**
     * Get products by ProductParamsDto
     */
    public function getProductsByParams(ProductParamsDto $params): LengthAwarePaginator;

    /**
     * Get products by category slud
     */
    public function getProductsByCategorySlug(string $slug, int $page, int $limit): LengthAwarePaginator;

    /**
     * Get products
     */
    public function getProducts(int $page, int $limit): LengthAwarePaginator;

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
     * Get top sale products
     * 
     * @param int $count  (number of products)
     */
    public function getTopSaleProducts(int $page, int $limit): LengthAwarePaginator;

    /**
     * Search for products
     */
    public function searchProducts(SearchProductsDto $params): LengthAwarePaginator;

    /**
     * Get related products
     * 
     * @param string $productId  (ID of product to find related products)
     * @param int $count  (number of products)
     */
    public function getRelatedProducts(string $productId, int $count): Collection;

    /**
     * Get top selling products
     * 
     * @param int $count (number of products)
     * @param string $time (week, month, year)
     */
    public function getTopSellingProducts(int $count, string $time): Collection;
}
