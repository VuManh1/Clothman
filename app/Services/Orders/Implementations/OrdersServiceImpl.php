<?php

namespace App\Services\Orders\Implementations;

use App\Exceptions\Orders\OrderNotFoundException;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepository;
use App\Services\Orders\Interfaces\OrdersService;
use Illuminate\Support\Collection;

class OrdersServiceImpl implements OrdersService
{
    public function __construct(
        private OrderRepository $orderRepository
    ) {}

    public function getOrdersForUser(string $userId, $page, $limit): Collection {
        return $this->orderRepository->getAll();
    }

    public function getOrderByCode(string $code): Order {
        $order = $this->orderRepository->findByCode($code, [
            'payment', 'user', 'orderItems', 'orderItems.product', 'orderItems.productVariantt'
        ]);

        if (!$order) {
            throw new OrderNotFoundException();
        }

        return $order;
    }
}
