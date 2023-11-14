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
            $query->where(function ($q) use($params) {
                $q->where("name", "LIKE", "%".$params->keyword."%")
                  ->orWhere("description", "LIKE", "%".$params->keyword."%");
            });
        }

        if ($params->sortColumn) {
            $query->orderBy($params->sortColumn, $params->sortOrder ?? "asc");
        }

        return $this->toPaginator($query, $params->page, $params->limit);
    }
}
