<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Banners\BannerParamsDto;
use App\Repositories\Interfaces\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Repository for Banner entity
 */
interface BannerRepository extends Repository
{
    /**
     * Find banners by BannerParamsDto
     */
    public function findByParams(BannerParamsDto $params): LengthAwarePaginator;
}
