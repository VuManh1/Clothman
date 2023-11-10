<?php

namespace App\Services\Products\Implementations;

use App\DTOs\Products\CreateProductDto;
use App\DTOs\Products\UpdateProductDto;
use App\Exceptions\UniqueFieldException;
use App\Models\Product;
use App\Repositories\Interfaces\ImageRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Services\Products\Interfaces\ManageProductsService;
use App\Services\Upload\Interfaces\UploadService;
use App\Utils\UploadFolder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ManageProductsServiceImpl implements ManageProductsService
{
    public function __construct(
        private ProductRepository $productRepository,
        private ProductVariantRepository $productVariantRepository,
        private ImageRepository $imageRepository,
        private UploadService $uploadService
    ) {}

    public function createProduct(CreateProductDto $createProductDto): Product {
        $sku = $this->generateSKUs();

        $thumbnailUploadedResult = $this->uploadService->uploadFile($createProductDto->thumbnail, [
            'folder' => UploadFolder::PRODUCT_IMAGES
        ]);

        if ($createProductDto->sizeGuild) {
            $sizeGuildUploadedResult = $this->uploadService->uploadFile($createProductDto->sizeGuild, [
                'folder' => UploadFolder::PRODUCT_IMAGES
            ]);
        }

        try {
            $product = $this->productRepository->create([
                'name' => $createProductDto->name,
                'slug' => Str::slug($createProductDto->name),
                'code' => $sku,
                'category_id' => $createProductDto->categoryId,
                'description' => $createProductDto->description,
                'material' => $createProductDto->material,
                'price' => $createProductDto->price,
                'discount' => $createProductDto->discount,
                'thumbnail_url' => $thumbnailUploadedResult['path'],
                'size_guild_url' => isset($sizeGuildUploadedResult) ? $sizeGuildUploadedResult['path'] : null,
            ]);

            $totalQuantity = 0;
            foreach ($createProductDto->colors as $color) {
                
                if ($createProductDto->colorSizes) {
                    foreach ($createProductDto->colorSizes[$color] as $size) {
                        $this->productVariantRepository->create([
                            'product_id' => $product->id,
                            'color_id' => $color,
                            'size' => $size,
                            'quantity' => $createProductDto->colorSizeQuantity[$color][$size],
                        ]);

                        $totalQuantity += $createProductDto->colorSizeQuantity[$color][$size];
                    }
                } else {
                    $this->productVariantRepository->create([
                        'product_id' => $product->id,
                        'color_id' => $color,
                        'size' => null,
                        'quantity' => $createProductDto->colorQuantity[$color],
                    ]);

                    $totalQuantity += $createProductDto->colorQuantity[$color];
                }

                if ($createProductDto->colorImages && $createProductDto->colorImages[$color]) {
                    foreach ($createProductDto->colorImages[$color] as $image) {
                        $result = $this->uploadService->uploadFile($image, ['folder' => UploadFolder::PRODUCT_IMAGES]);

                        $this->imageRepository->create([
                            'product_id' => $product->id,
                            'color_id' => $color,
                            'image_url' => $result['path'] 
                        ]);
                    }
                }
            }

            $this->productRepository->update($product->id, [
                'quantity' => $totalQuantity
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
 
            throw new UniqueFieldException();
        }

        return $product;
    }

    public function updateProduct($id, UpdateProductDto $updateProductDto): Product {
        $slug = Str::slug($updateProductDto->name);

        return $this->productRepository->update($id, []);
    }

    public function deleteProduct($id): bool {

        return $this->productRepository->delete($id);
    }

    private function generateSKUs() : string {
        $timestamp = now()->timestamp;
        $randomString = Str::random(4);

        $sku = 'CTL' . $timestamp . $randomString;

        return $sku;
    }
}
