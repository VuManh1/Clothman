<?php

namespace App\Repositories\Implementations;

use App\DTOs\Categories\CategoryParamsDto;
use App\Exceptions\Categories\CategoryNotFoundException;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class EloquentCategoryRepository extends EloquentRepository implements CategoryRepository
{
    public function __construct() {
        parent::__construct(Category::class);
    }

    public function findByParams(CategoryParamsDto $params): LengthAwarePaginator {
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

    public function findByParentId(?string $parentId, array $includes = null): Collection {
        if ($includes) {
            return $this->model->with($includes)->where('parent_id', $parentId)->get();
        }

        return $this->model->where('parent_id', $parentId)->get();
    }

    public function getHomeCategories(int $productsCount): Collection {
        return $this->model->with(['products' => function (Builder $query) use($productsCount) {
            $query->orderBy('sold', 'desc')->take($productsCount);
        }])->where('display_in_home', true)->get();
    }
}
