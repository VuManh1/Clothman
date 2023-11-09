<?php

namespace App\Services\Products\Interfaces;

use App\DTOs\Products\ProductParamsDto;
use App\Models\Product;

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
}
