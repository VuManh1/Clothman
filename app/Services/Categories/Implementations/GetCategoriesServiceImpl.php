<?php

namespace App\Services\Categories\Implementations;

use App\DTOs\Categories\CategoryParamsDto;
use App\Exceptions\Categories\CategoryNotFoundException;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Categories\Interfaces\GetCategoriesService;
use Illuminate\Database\Eloquent\Collection;

class GetCategoriesServiceImpl implements GetCategoriesService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function getCategories(CategoryParamsDto $params = null) {
        if (!$params) {
            return $this->categoryRepository->getAll();
        }

        $params->includes = ['parent'];

        return $this->categoryRepository->getCategoriesByParams($params);
    }

    public function getCategoryById(string $id): Category {
        $category = $this->categoryRepository->findById($id, ['parent']);

        if (!$category) throw new CategoryNotFoundException();

        return $category;
    }

    public function getAllParentCategories(): Collection {
        $categories = $this->categoryRepository->getAllParentCategories();

        return $categories;
    }
}
