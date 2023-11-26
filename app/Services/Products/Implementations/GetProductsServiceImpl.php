<?php

namespace App\Services\Products\Implementations;

use App\DTOs\Products\ProductParamsDto;
use App\DTOs\Products\SearchProductsDto;
use App\Exceptions\Products\ProductNotFoundException;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\SoldRepository;
use App\Services\Products\Interfaces\GetProductsService;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class GetProductsServiceImpl implements GetProductsService
{
    public function __construct(
        private ProductRepository $productRepository,
        private SoldRepository $soldRepository
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

    public function getTopSellingProducts(int $count, string $time): Collection {
        $from = Carbon::now();
        $to = Carbon::now();

        switch ($time) {
            case 'week':
                $from = Carbon::now()->subWeek();
                break;
            case 'month':
                $from = Carbon::now()->subMonth();
                break;
            case 'year':
                $from = Carbon::now()->subYear();
                break;
            default:
                throw new InvalidArgumentException();
                break;
        }
       
        $solds = $this->soldRepository->getTopCountInTimeRange($count, $from, $to);
        $collection = collect();

        foreach ($solds as $item) {
            $collection->push([
                'total' => $item->total,
                'product' => $item->product,
            ]);
        }

        $numberOfRecords = $collection->count();
        
        // if not enough products, take another products order by sold to fill it
        if ($numberOfRecords < $count) {
            $productsToAdd = $this->productRepository->whereIdNotIn(
                $solds->pluck('product.id')->all(), // exclude product's id
                $count - $numberOfRecords,
                [ 'column' => 'sold', 'order' => 'desc' ],
                ['category']
            );

            foreach ($productsToAdd as $product) {
                $collection->push([
                    'total' => 0,
                    'product' => $product
                ]);
            }
        }

        return $collection;
    }
}
