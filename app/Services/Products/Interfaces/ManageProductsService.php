<?php

namespace App\Services\Products\Interfaces;

use App\DTOs\Products\CreateProductDto;
use App\DTOs\Products\UpdateProductDto;

/**
 * Service Interface for product to deal with CUD (Create, Update, Delete) operations
 */
interface ManageProductsService
{
    /**
     * Create a product
     */
    public function createProduct(CreateProductDto $createProductDto);
    
    /**
     * Update a product
     */
    public function updateProduct($id, UpdateProductDto $updateProductDto);

    /**
     * Delete a product
     */
    public function deleteProduct($id);
}
