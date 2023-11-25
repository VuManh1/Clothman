<?php

namespace App\Repositories\Implementations;

use App\Models\Sale;
use App\Repositories\Interfaces\SaleRepository;

class EloquentSaleRepository extends EloquentRepository implements SaleRepository
{
    public function __construct() {
        parent::__construct(Sale::class);
    }
}
