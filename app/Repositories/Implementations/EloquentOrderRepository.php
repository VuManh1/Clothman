<?php

namespace App\Repositories\Implementations;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepository;

class EloquentOrderRepository extends EloquentRepository implements OrderRepository
{
    public function __construct() {
        parent::__construct(Order::class);
    }

    public function findByCode(string $code, array $includes = null): ?Order {
        if ($includes) {
            return $this->model->with($includes)->where('code', $code)->first();
        }

        return $this->model->where('code', $code)->first();
    }
}
