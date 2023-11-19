<?php

namespace App\Repositories\Implementations;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepository;

class EloquentOrderRepository extends EloquentRepository implements OrderRepository
{
    public function __construct() {
        parent::__construct(Order::class);
    }
}
