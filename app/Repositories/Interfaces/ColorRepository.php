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
     * Get colors by ColorParamsDto
     */
    public function getColorsByParams(ColorParamsDto $params): LengthAwarePaginator;
}
