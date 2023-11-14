<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Colors\ColorParamsDto;
use App\Repositories\Interfaces\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Repository for Color entity
 */
interface ColorRepository extends Repository
{
    /**
     * Find colors by ColorParamsDto
     */
    public function findByParams(ColorParamsDto $params): LengthAwarePaginator;
}
