<?php

namespace App\Services\Categories\Implementations;

use App\DTOs\Categories\CategoryParamsDto;
use App\Exceptions\Categories\CategoryNotFoundException;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Categories\Interfaces\GetCategoriesService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GetCategoriesServiceImpl implements GetCategoriesService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function getAllCategories(): Collection {
        return $this->categoryRepository->getAll();
    }

    public function getCategoriesByParams(CategoryParamsDto $params): LengthAwarePaginator {
        $params->includes = ['parent'];
        
        return $this->categoryRepository->findByParams($params);
    }

    public function getCategoryById(string $id, array $includes = null): Category {
        $category = $this->categoryRepository->findById($id, $includes);

        if (!$category) throw new CategoryNotFoundException();

        return $category;
    }

    public function getCategoryBySlug(string $slug, array $includes = null): Category {
        $category = $this->categoryRepository->findBySlug($slug, $includes);

        if (!$category) throw new CategoryNotFoundException();

        return $category;
    }

    public function getParentCategoriesWithChilds(): Collection {
        return $this->categoryRepository->findByParentId(null, ['childs']);
    }

    public function getHomeCategories(int $productsCount): Collection {
        return $this->categoryRepository->getHomeCategories($productsCount);
    }
}
