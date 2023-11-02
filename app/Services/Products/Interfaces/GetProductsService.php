<?php

namespace App\Services\Products\Interfaces;

/**
 * Service Interface for product to deal with Read operations
 */
interface GetProductsService
{
    /**
     * Get products
     * @return mixed
     */
    public function get();
}
