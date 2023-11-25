<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\Repository;

/**
 * Repository for Sale entity
 */
interface SaleRepository extends Repository
{
    public function getYearlyStats(int $year);
}
