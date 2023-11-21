<?php

namespace App\Repositories\Implementations;

use App\Models\Sold;
use App\Repositories\Interfaces\SoldRepository;

class EloquentSoldRepository extends EloquentRepository implements SoldRepository
{
    public function __construct() {
        parent::__construct(Sold::class);
    }
}
