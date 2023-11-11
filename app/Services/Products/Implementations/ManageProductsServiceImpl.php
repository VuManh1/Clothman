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

        DB::beginTransaction();
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
            $createProductDto->variants ??= [];
            foreach ($createProductDto->variants as $variant) {
                $this->productVariantRepository->create([
                    'product_id' => $product->id,
                    'color_id' => $variant['colorId'],
                    'size' => $variant['size'] ?? "NONE",
                    'quantity' => $variant['quantity'],
                ]);

                $totalQuantity += $variant['quantity'];
            }

            // Upload color images
            $createProductDto->colorImages ??= [];
            foreach ($createProductDto->colorImages as $colorImage) {
                $uploadResult = $this->uploadService->uploadFile($colorImage['image'], [
                    'folder' => UploadFolder::PRODUCT_IMAGES
                ]);

                $this->imageRepository->create([
                    'product_id' => $product->id,
                    'color_id' => $colorImage['colorId'],
                    'image_url' => $uploadResult['path'],
                ]);
            }

            $this->productRepository->update($product->id, [
                'quantity' => $totalQuantity
            ]);

            DB::commit();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            // If have any error, delete files create previout
            $this->uploadService->deleteFile($thumbnailUploadedResult['path']);
            
            if (isset($sizeGuildUploadedResult)) {
                $this->uploadService->deleteFile($sizeGuildUploadedResult['path']);
            }
            
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
