<?php

namespace App\Services\Categories\Implementations;

use App\DTOs\Categories\CreateCategoryDto;
use App\DTOs\Categories\UpdateCategoryDto;
use App\Exceptions\Categories\CategoryCanNotDeleteException;
use App\Exceptions\Categories\CategoryDuplicateException;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Categories\Interfaces\ManageCategoriesService;
use App\Services\Upload\Interfaces\UploadService;
use App\Utils\UploadFolder;
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
        } catch (\Illuminate\Database\QueryException $th) {
            // if have any error, delete the file created previous
            $this->uploadService->deleteFile($uploadResult['path']);

            throw new CategoryDuplicateException();
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
        $uploadResult = null;
        if ($updateCategoryDto->banner) {
            $uploadResult = $this->uploadService->uploadFile($updateCategoryDto->banner, [
                'folder' => UploadFolder::CATEGORY_BANNERS
            ]);

            $data['banner_url'] = $uploadResult['path'];
        }

        try {
            return $this->categoryRepository->update($id, $data);
        } catch (\Illuminate\Database\QueryException $ex) {
            // if have any error, delete the file created previous if have
            if ($uploadResult) {
                $this->uploadService->deleteFile($uploadResult['path']);
            }

            throw new CategoryDuplicateException();
        }
    }

    public function deleteCategory($id): bool {
        $isChildExists = $this->categoryRepository->checkChildExists($id);

        // not allow to delete category if it have child category
        if ($isChildExists) {
            throw new CategoryCanNotDeleteException("Không thể xóa thể loại này vì có ít nhất một thể loại con !");
        }

        return $this->categoryRepository->delete($id);
    }
}
