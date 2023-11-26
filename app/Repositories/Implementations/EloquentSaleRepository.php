<?php

namespace App\Repositories\Implementations;

use App\Models\Sale;
use App\Repositories\Interfaces\SaleRepository;
use Illuminate\Support\Collection;

class EloquentSaleRepository extends EloquentRepository implements SaleRepository
{
    public function __construct() {
        parent::__construct(Sale::class);
    }

    public function getYearStats(int $year): Collection {
        return $this->model->selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total')
        ->whereYear('date', $year)
        ->groupBy('year', 'month')
        ->get();
    }

    public function findByDate(string $date): ?Sale {
        return $this->model->whereDate('date', $date)->first();
    }
}
