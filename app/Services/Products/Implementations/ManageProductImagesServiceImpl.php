<?php

namespace App\Services\Products\Implementations;

use App\Exceptions\Products\ProductNotFoundException;
use App\Repositories\Interfaces\ImageRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\Products\Interfaces\ManageProductImagesService;
use App\Services\Upload\Interfaces\UploadService;
use App\Utils\UploadFolder;
use Exception;
use Illuminate\Support\Facades\DB;

class ManageProductImagesServiceImpl implements ManageProductImagesService
{
    public function __construct(
        private ProductRepository $productRepository,
        private ImageRepository $imageRepository,
        private UploadService $uploadService
    ) {}

    public function updateProductColorImages(string $productId, string $colorId, array $images): int {
        $total = 0;

        $product = $this->productRepository->findById($productId, ['images']);

        if (!$product) throw new ProductNotFoundException();

        $imageIdsToDelete = $product->images->where('color_id', $colorId)->pluck('id');

        DB::beginTransaction();
        try {
            $this->imageRepository->deleteMany($imageIdsToDelete);

            // delete images in disk
            $this->uploadService->deleteFolder(UploadFolder::PRODUCT_IMAGES . '/' . $productId . '/color-' . $colorId);

            foreach ($images as $image) {
                $uploadResult = $this->uploadService->uploadFile($image, [
                    'folder' => UploadFolder::PRODUCT_IMAGES . '/' . $productId . '/color-' . $colorId
                ]);

                $this->imageRepository->create([
                    'product_id' => $productId,
                    'color_id' => $colorId,
                    'image_url' => $uploadResult['path'],
                ]);

                $total += 1;
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();

            throw $ex;
        }

        return $total;
    }
}
