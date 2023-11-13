<?php

namespace App\Repositories\Implementations;

use App\DTOs\Products\ProductParamsDto;
use App\Exceptions\Products\ProductNotFoundException;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentProductRepository extends EloquentRepository implements ProductRepository
{
    public function __construct() {
        parent::__construct(Product::class);
    }

    public function getProductsByParams(ProductParamsDto $params): LengthAwarePaginator {
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
            $query->whereRelation('category', 'slug', $params->category);
        }

        if ($params->sortColumn) {
            $query->orderBy($params->sortColumn, $params->sortOrder ?? "asc");
        }

        return $this->toPaginator($query, $params->page, $params->limit);
    }

    public function checkHaveOrder(string $id): bool {
        $product = $this->findById($id);

        if (!$product) throw new ProductNotFoundException();

        return $product->orders()->exists();
    }

    public function getLatestProducts(int $count): Collection {
        return $this->model->orderBy('updated_at', 'desc')->take($count)->get();
    }
}
