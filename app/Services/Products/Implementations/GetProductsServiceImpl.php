<?php

namespace App\Services\Products\Implementations;

use App\DTOs\Products\ProductParamsDto;
use App\Exceptions\Products\ProductNotFoundException;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\Products\Interfaces\GetProductsService;
use Illuminate\Support\Collection;

class GetProductsServiceImpl implements GetProductsService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function getProducts(?ProductParamsDto $params) { 
        if (!$params) {
            return $this->productRepository->getAll();
        }

        $params->includes = ['category'];
        if (!$params->sortColumn) {
            $params->sortColumn = "updated_at";
            $params->sortOrder = "desc";
        }

        return $this->productRepository->getProductsByParams($params);
    }

    public function getProductById(string $id): Product {
        $product = $this->productRepository->findById($id);

        if (!$product) throw new ProductNotFoundException();

        return $product;
    }

    public function getProductBySlugWithAllDetails(string $slug): Product {
        $product = $this->productRepository->findBySlug($slug, ['category', 'productVariants', 'images']);

        if (!$product) throw new ProductNotFoundException();

        return $product;
    }

    public function getProductByIdWithAllDetails(string $id): Product {
        $product = $this->productRepository->findById($id, ['category', 'productVariants', 'images']);

        if (!$product) throw new ProductNotFoundException();

        return $product; 
    }

    public function getLatestProducts(int $count): Collection {
        return $this->productRepository->getProductsOrderByUpdatedAtDesc($count);
    }

    public function getTopSoldProducts(int $count): Collection {
        return $this->productRepository->getProductsOrderBySoldDesc($count);
    }
}
