<?php

namespace App\Repositories\Interfaces;

use App\Models\Order;
use App\Repositories\Interfaces\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Repository for Order entity
 */
interface OrderRepository extends Repository
{
    /**
     * Get one order by Code
     */
    public function findByCode(string $code, array $includes = null): ?Order;

    /**
     * Get orders by user id
     */
    public function findByUserId(string $userId, int $page, int $limit, array $includes = null): LengthAwarePaginator;
}
