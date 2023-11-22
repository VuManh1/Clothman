<?php

namespace App\Services\Products\Implementations;

use App\DTOs\Products\ProductParamsDto;
use App\DTOs\Products\SearchProductsDto;
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

    public function getProductsByCategorySlug(string $slug, int $page, int $limit): LengthAwarePaginator {
        return $this->productRepository->findByCategorySlug($slug, $page, $limit);
    }

    public function getProducts(int $page, int $limit): LengthAwarePaginator {
        return $this->productRepository->get($page, $limit, [
            'column' => 'updated_at',
            'order' => 'desc'
        ]);
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
        return $this->productRepository->orderByAndTake('updated_at', 'desc', $count);
    }

    public function getTopSoldProducts(int $count): Collection {
        return $this->productRepository->orderByAndTake('sold', 'desc', $count);
    }

    public function searchProducts(SearchProductsDto $params): LengthAwarePaginator {
        return $this->productRepository->searchProducts($params);
    }

    public function getTopSaleProducts(int $page, int $limit): LengthAwarePaginator {
        return $this->productRepository->getDiscountProducts($page, $limit);
    }

    public function getRelatedProducts(string $productId, int $count): Collection {
        $product = $this->getProductById($productId, ['category']);
        $categorySlug = $product->category->slug;

        $products = $this->getProductsByCategorySlug($categorySlug, 0, $count);

        return $products->getCollection();
    }
}
