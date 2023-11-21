<?php

namespace App\Repositories\Implementations;

use App\Models\OrderItem;
use App\Repositories\Interfaces\OrderItemRepository;

class EloquentOrderItemRepository extends EloquentRepository implements OrderItemRepository
{
    public function __construct() {
        parent::__construct(OrderItem::class);
    }
}
