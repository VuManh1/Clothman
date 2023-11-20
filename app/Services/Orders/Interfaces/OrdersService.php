<?php

namespace App\Services\Orders\Interfaces;

use App\Models\Order;
use Illuminate\Support\Collection;

interface OrdersService
{
    /**
     * Get orders for an user
     */
    public function getOrdersForUser(string $userId, $page, $limit): Collection;

    /**
     * Get one order by code
     */
    public function getOrderByCode(string $code): Order;
}
