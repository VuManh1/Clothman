<?php

namespace App\Services\Products\Implementations;

use App\DTOs\Products\ProductParamsDto;
use App\Exceptions\Products\ProductNotFoundException;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\Products\Interfaces\GetProductsService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GetProductsServiceImpl implements GetProductsService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function getProductsByParams(ProductParamsDto $params): LengthAwarePaginator { 
        $params->includes = ['category'];
        if (!$params->sortColumn) {
            $params->sortColumn = "updated_at";
            $params->sortOrder = "desc";
        }

        return $this->productRepository->findByParams($params);
    }

    public function getProductById(string $id, array $includes = null): Product {
        $product = $this->productRepository->findById($id, $includes);

        if (!$product) throw new ProductNotFoundException();

        return $product;
    }

    public function getProductBySlug(string $slug, array $includes = null): Product {
        $product = $this->productRepository->findBySlug($slug, $includes);

        if (!$product) throw new ProductNotFoundException();

        return $product;
    }

    public function getLatestProducts(int $count): Collection {
        return $this->productRepository->getProductsOrderBy('updated_at', 'desc', $count);
    }

    public function getTopSoldProducts(int $count): Collection {
        return $this->productRepository->getProductsOrderBy('sold', 'desc', $count);
    }
}
