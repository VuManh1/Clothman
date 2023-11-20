<?php

namespace App\Repositories\Interfaces;

use App\Models\Order;
use App\Repositories\Interfaces\Repository;

/**
 * Repository for Order entity
 */
interface OrderRepository extends Repository
{
    /**
     * Get one order by Code
     */
    public function findByCode(string $code, array $includes = null): ?Order;
}
