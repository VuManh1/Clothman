<?php

namespace App\Repositories\Implementations;

use App\Models\Sale;
use App\Repositories\Interfaces\SaleRepository;

class EloquentSaleRepository extends EloquentRepository implements SaleRepository
{
    public function __construct() {
        parent::__construct(Sale::class);
    }

    public function getYearlyStats(int $year) {
        return $this->model->selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total')
        ->whereYear('date', $year)
        ->groupBy('year', 'month')
        ->get();
    }
}
