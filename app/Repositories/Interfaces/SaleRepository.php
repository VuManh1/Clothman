<?php

namespace App\Repositories\Interfaces;

use App\Models\Sale;
use App\Repositories\Interfaces\Repository;
use Illuminate\Support\Collection;

/**
 * Repository for Sale entity
 */
interface SaleRepository extends Repository
{
    public function getYearStats(int $year): Collection;

    public function findByDate(string $date): ?Sale;
}
