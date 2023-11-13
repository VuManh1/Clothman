<?php

namespace App\Services\Products\Interfaces;

use App\DTOs\Products\ProductParamsDto;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service Interface for product to deal with Read operations
 */
interface GetProductsService
{
    /**
     * Get products
     * @return mixed
     */
    public function getProducts(?ProductParamsDto $params);

    /**
     * Get one product by ID
     * @return \App\Models\Product
     * @throws \App\Exceptions\Products\ProductNotFoundException
     */
    public function getProductById(string $id): Product;

    /**
     * Get one product by ID with all of it's relationships
     * @return \App\Models\Product
     * @throws \App\Exceptions\Products\ProductNotFoundException
     */
    public function getProductByIdWithAllDetails(string $id): Product;

    /**
     * Get latest products
     * 
     * @param int $count  (number of products)
     */
    public function getLatestProducts(int $count): Collection;
}
