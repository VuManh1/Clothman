<?php

namespace App\Services\Orders\Interfaces;

use App\DTOs\Orders\CreateOrderDto;
use App\DTOs\Orders\OrderParamsDto;
use App\DTOs\Orders\UpdateOrderDto;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrdersService
{
    /**
     * Get orders by params
     */
    public function getOrdersByParams(OrderParamsDto $params): LengthAwarePaginator;

    /**
     * Get orders for an user
     */
    public function getOrdersForUser(string $userId, $page, $limit): LengthAwarePaginator;

    /**
     * Get one order by code
     */
    public function getOrderByCode(string $code): Order;

    /**
     * Create an order
     */
    public function createOrder(CreateOrderDto $createOrderDto): Order;

    /**
     * Update an order
     */
    public function updateOrder(string $code, UpdateOrderDto $updateOrderDto): Order;

    /**
     * Cancel an order
     */
    public function cancelOrder(string $code, string $cancelReson = null): bool;
}
