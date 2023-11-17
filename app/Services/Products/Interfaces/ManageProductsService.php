<?php

namespace App\Services\Products\Interfaces;

use App\DTOs\Products\CreateProductDto;
use App\DTOs\Products\UpdateProductDto;
use App\Models\Product;

/**
 * Service Interface for product to deal with CUD (Create, Update, Delete) operations
 */
interface ManageProductsService
{
    /**
     * Create a product
     */
    public function createProduct(CreateProductDto $createProductDto): Product;
    
    /**
     * Update a product
     */
    public function updateProduct($id, UpdateProductDto $updateProductDto): Product;

    /**
     * Update a product variant quantity
     */
    public function updateProductVariant(string $id, int $quantity): bool;

    /**
     * Delete a product
     */
    public function deleteProduct($id): bool;
}
