<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\Repository;

/**
 * Repository for product entity
 */
interface ProductRepository extends Repository
{
    /**
     * Check if a product have at least one order
     * @param string $id (id of product to check)
     */
    public function checkHaveOrder(string $id): bool;
}
