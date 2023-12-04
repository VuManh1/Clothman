<?php

namespace App\Repositories\Implementations;

use App\DTOs\Products\ProductParamsDto;
use App\DTOs\Products\SearchProductsDto;
use App\Exceptions\Products\ProductNotFoundException;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentProductRepository extends EloquentRepository implements ProductRepository
{
    public function __construct() {
        parent::__construct(Product::class);
    }

    public function findByParams(ProductParamsDto $params): LengthAwarePaginator {
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
        if (isset($params->category)) {
            $query->whereHas('category', function ($q) use($params) {
                $q->where('slug', $params->category)
                  ->orWhereRelation('parent', 'slug', $params->category);
            });
        }

        if ($params->sortColumn) {
            $query->orderBy($params->sortColumn, $params->sortOrder ?? "asc");
        }

        return $this->toPaginator($query, $params->page, $params->limit);
    }

    public function findBySlug(string $slug, array $includes = null): ?Product {
        if ($includes) {
            return $this->model->with($includes)->where('slug', $slug)->first();
        }

        return $this->model->where('slug', $slug)->first();
    }

    public function findByCategorySlug(string $slug, int $page, int $limit): LengthAwarePaginator {
        $query = $this->model->query();

        $query->whereHas('category', function ($q) use($slug) {
            $q->where('slug', $slug)
              ->orWhereRelation('parent', 'slug', $slug);
        });

        $query->orderBy('updated_at', 'desc');

        return $this->toPaginator($query, $page, $limit);
    }

    public function checkHaveOrder(string $id): bool {
        $product = $this->findById($id);

        if (!$product) throw new ProductNotFoundException();

        return $product->orders()->take(1)->exists();
    }

    public function searchProducts(SearchProductsDto $params): LengthAwarePaginator {
        $query = $this->model->query();

        if ($params->keyword) {
            $query->where(function ($q) use($params) {
                $q->where("name", "LIKE", "%".$params->keyword."%")
                  ->orWhere("description", "LIKE", "%".$params->keyword."%")
                  ->orWhereRelation("category", "name", "LIKE", "%".$params->keyword."%");
            });
        }
        if (isset($params->category)) {
            $query->whereHas('category', function ($q) use($params) {
                $q->where('slug', $params->category)
                  ->orWhereRelation('parent', 'slug', $params->category);
            });
        }

        return $this->toPaginator($query, $params->page, $params->limit);
    }

    public function getDiscountProducts(int $page, int $limit, string $order = "desc"): LengthAwarePaginator {
        $query = $this->model->query();

        $query->where('discount', '>', 0)->orderBy('discount', $order);

        return $this->toPaginator($query, $page, $limit);
    }
}
