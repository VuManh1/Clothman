<?php

namespace App\Repositories\Interfaces;

use App\Models\Sold;
use App\Repositories\Interfaces\Repository;

/**
 * Repository for Sold entity
 */
interface SoldRepository extends Repository
{
    public function findByProductIdAndDate(string $productId, string $date): ?Sold;

    public function getTopCountInTimeRange(int $limit, string $from, string $to);
}
