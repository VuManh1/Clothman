<?php

namespace App\Services\Products\Implementations;

use App\DTOs\Products\ProductParamsDto;
use App\Exceptions\Products\ProductNotFoundException;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\Products\Interfaces\GetProductsService;

class GetProductsServiceImpl implements GetProductsService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function getProducts(?ProductParamsDto $params) { 
        if (!$params) {
            return $this->productRepository->getAll();
        }

        $filters = null;
        if ($params->keyword) {
            $filters = [
                'column' => 'name',
                'operator' => 'LIKE',
                'value' => '%'.$params->keyword.'%'
            ];
        }

        $sorts = null;
        if ($params->sort) {
            $sorts = ['column' => $params->sort, 'by' => $params->by];
        }

        return $this->productRepository->find(
            $params->page,
            $params->limit,
            $filters,
            $sorts,
            $params->includes
        );
    }

    public function getProductById(string $id): Product {
        $product = $this->productRepository->findById($id);

        if (!$product) throw new ProductNotFoundException();

        return $product;
    }

    public function getProductByIdWithAllDetails(string $id): Product {
        $product = $this->productRepository->findById($id, ['category', 'productVariants', 'images']);

        if (!$product) throw new ProductNotFoundException();

        return $product; 
    }
}
