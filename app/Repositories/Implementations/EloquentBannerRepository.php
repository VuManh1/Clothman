<?php

namespace App\Repositories\Implementations;

use App\DTOs\Banners\BannerParamsDto;
use App\Exceptions\Banners\BannerNotFoundException;
use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentBannerRepository extends EloquentRepository implements BannerRepository
{
    public function __construct() {
        parent::__construct(Banner::class);
    }

    public function findByParams(BannerParamsDto $params): LengthAwarePaginator {
        $query = $this->model->query();

        if ($params->keyword) {
            $query->where("name", "LIKE", "%".$params->keyword."%");
        }
        if ($params->isActive !== null) {
            $query->where("is_active", $params->isActive);
        }

        if ($params->sortColumn) {
            $query->orderBy($params->sortColumn, $params->sortOrder ?? "asc");
        }

        return $this->toPaginator($query, $params->page, $params->limit);
    }
}
