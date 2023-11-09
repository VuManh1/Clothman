<?php

namespace App\Services\Products\Implementations;

use App\DTOs\Products\CreateProductDto;
use App\DTOs\Products\UpdateProductDto;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\Products\Interfaces\ManageProductsService;
use App\Services\Upload\Interfaces\UploadService;
use App\Utils\UploadFolder;
use Error;
use Illuminate\Support\Str;

class ManageProductsServiceImpl implements ManageProductsService
{
    public function __construct(
        private ProductRepository $productRepository,
        private UploadService $uploadService
    ) {}

    public function createProduct(CreateProductDto $createProductDto): Product {
        $slug = Str::slug($createProductDto->name);

        try {
            return $this->productRepository->create([]);
        } catch (\Throwable $th) {

            throw new Error();
        }
    }

    public function updateProduct($id, UpdateProductDto $updateProductDto): Product {
        $slug = Str::slug($updateProductDto->name);

        return $this->productRepository->update($id, []);
    }

    public function deleteProduct($id): bool {

        return $this->productRepository->delete($id);
    }
}
