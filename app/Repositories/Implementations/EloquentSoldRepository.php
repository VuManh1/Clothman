<?php

namespace App\Repositories\Implementations;

use App\Models\Sold;
use App\Repositories\Interfaces\SoldRepository;

class EloquentSoldRepository extends EloquentRepository implements SoldRepository
{
    public function __construct() {
        parent::__construct(Sold::class);
    }
    
    public function findByProductIdAndDate(string $productId, string $date): ?Sold {
        return $this->model
            ->where('product_id', $productId)
            ->where('date', $date)
            ->first();
    }

    public function getTopCountInTimeRange(int $limit, string $from, string $to) {
        return $this->model->selectRaw('product_id, SUM(count) as total')
            ->with('product.category')
            ->whereDate('date', '>=', $from)
            ->whereDate('date', '<=', $to)
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->limit($limit)
            ->get();
    }
}
