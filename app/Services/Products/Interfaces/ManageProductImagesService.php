<?php

namespace App\Services\Products\Interfaces;

/**
 * Service Interface for product to manage its images
 */
interface ManageProductImagesService
{
    /**
     * Update images of product color variant
     */
    public function updateProductColorImages(string $productId, string $colorId, array $images): int;
}
