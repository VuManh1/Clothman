<?php

namespace App\Repositories\Implementations;

use App\DTOs\Colors\ColorParamsDto;
use App\Models\Color;
use App\Repositories\Interfaces\ColorRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentColorRepository extends EloquentRepository implements ColorRepository
{
    public function __construct() {
        parent::__construct(Color::class);
    }

    public function getColorsByParams(ColorParamsDto $params): LengthAwarePaginator {
        $query = $this->model->query();

        if ($params->keyword) {
            $query->where(function ($q) use($params) {
                $q->where("name", "LIKE", "%".$params->keyword."%")
                  ->orWhere("hex_code", "LIKE", "%".$params->keyword."%");
            });
        }

        if ($params->sortColumn) {
            $query->orderBy($params->sortColumn, $params->sortOrder ?? "asc");
        }

        return $this->toPaginator($query, $params->page, $params->limit);
    }
}
