<?php

namespace App\Services\Products\Interfaces;

use App\DTOs\Products\CreateProductDto;
use App\DTOs\Products\UpdateProductDto;
use App\Models\Product;

/**
 * Service Interface for product to manage its variants
 */
interface ManageProductVariantsService
{
    /**
     * Update a product variant quantity
     */
    public function updateProductVariantQuantity(string $id, int $quantity): bool;

    /**
     * Delete a product variant
     */
    public function deleteProductVariant(string $id): bool;
}
