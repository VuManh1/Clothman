<?php

namespace App\Services\Products\Implementations;

use App\Repositories\Interfaces\ProductRepository;
use App\Services\Products\Interfaces\GetProductsService;

class GetProductsServiceImpl implements GetProductsService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function get() { 
        return $this->productRepository->getAll();
    }
}
