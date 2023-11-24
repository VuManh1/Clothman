<?php

namespace App\Services\Products\Interfaces;

use App\DTOs\Products\CreateProductVariantDto;

/**
 * Service Interface for product to manage its variants
 */
interface ManageProductVariantsService
{
    /**
     * Create a product variant
     */
    public function createProductVariant(CreateProductVariantDto $data): bool;

    /**
     * Update a product variant quantity
     */
    public function updateProductVariantQuantity(string $id, int $quantity): bool;

    /**
     * Delete a product variant
     */
    public function deleteProductVariant(string $id): bool;
}
