<?php

namespace App\Services\Categories\Implementations;

use App\DTOs\Categories\CreateCategoryDto;
use App\DTOs\Categories\UpdateCategoryDto;
use App\Exceptions\Categories\CategoryNotFoundException;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Categories\Interfaces\ManageCategoriesService;
use App\Services\Upload\Interfaces\UploadService;
use App\Utils\UploadFolder;
use Error;
use Illuminate\Support\Str;

class ManageCategoriesServiceImpl implements ManageCategoriesService
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private UploadService $uploadService
    ) {}

    public function createCategory(CreateCategoryDto $createCategoryDto): Category {
        $slug = Str::slug($createCategoryDto->name);

        $uploadResult = $this->uploadService->uploadFile($createCategoryDto->banner, [
            'folder' => UploadFolder::CATEGORY_BANNERS
        ]);

        try {
            return $this->categoryRepository->create([
                "name"=> $createCategoryDto->name,
                "slug"=> $slug,
                "description"=> $createCategoryDto->description,
                'banner_url' => $uploadResult['path'],
                'parent_id' => $createCategoryDto->parentId ?? null
            ]);
        } catch (\Throwable $th) {
            // if have any error, delete the file created previous
            $this->uploadService->deleteFile($uploadResult['path']);

            throw new Error();
        }
    }

    public function updateCategory($id, UpdateCategoryDto $updateCategoryDto): Category {
        $slug = Str::slug($updateCategoryDto->name);
        $data = [
            "name"=> $updateCategoryDto->name,
            "slug"=> $slug,
            "description"=> $updateCategoryDto->description,
            'parent_id' => $updateCategoryDto->parentId ?? null,
            'display_in_home' => $updateCategoryDto->displayInHome
        ];

        // if have an image, upload it and assign path to $data
        if ($updateCategoryDto->banner) {
            $uploadResult = $this->uploadService->uploadFile($updateCategoryDto->banner, [
                'folder' => UploadFolder::CATEGORY_BANNERS
            ]);

            $data['banner_url'] = $uploadResult['path'];
        }

        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategory($id): bool {
        return $this->categoryRepository->delete($id);
    }
}
