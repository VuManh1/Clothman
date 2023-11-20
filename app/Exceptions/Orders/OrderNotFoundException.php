<?php

namespace App\Exceptions\Orders;

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Exception thrown if trying to get an order which not exists in database
 */
class OrderNotFoundException extends ModelNotFoundException
{
    public function __construct()
    {
        parent::__construct("Order was not found");
    }
}
