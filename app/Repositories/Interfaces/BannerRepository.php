<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Banners\BannerParamsDto;
use App\Repositories\Interfaces\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Repository for Banner entity
 */
interface BannerRepository extends Repository
{
    /**
     * Find banners by BannerParamsDto
     */
    public function findByParams(BannerParamsDto $params): LengthAwarePaginator;

    /**
     * Find banners by is_active field
     */
    public function findByIsActive(bool $isActive): Collection;
}
