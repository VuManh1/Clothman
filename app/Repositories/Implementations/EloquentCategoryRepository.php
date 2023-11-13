<?php

namespace App\Repositories\Implementations;

use App\DTOs\Categories\CategoryParamsDto;
use App\Exceptions\Categories\CategoryNotFoundException;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentCategoryRepository extends EloquentRepository implements CategoryRepository
{
    public function __construct() {
        parent::__construct(Category::class);
    }

    public function getCategoriesByParams(CategoryParamsDto $params): LengthAwarePaginator {
        $query = $this->model->query();

        if ($params->includes) {
            $query->with($params->includes);
        }

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

    public function checkChildExists(string $id): bool {
        $category = $this->findById($id);

        if (!$category) throw new CategoryNotFoundException();

        return $category->childs()->take(1)->exists();
    }

    public function getAllParentCategories(): Collection
    {
        return $this->model->with('childs')->where('parent_id', null)->get();
    }
}
