<?php

namespace App\Services\Categories\Implementations;

use App\DTOs\Categories\CategoryParamsDto;
use App\Exceptions\Categories\CategoryNotFoundException;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Categories\Interfaces\GetCategoriesService;

class GetCategoriesServiceImpl implements GetCategoriesService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function getCategories(CategoryParamsDto $params = null) {
        if (!$params) {
            return $this->categoryRepository->getAll();
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

        $categories = $this->categoryRepository->find(
            $params->page,
            $params->limit,
            $filters,
            $sorts
        );

        return $categories;
    }

    public function getCategoryById(string $id): Category {
        $category = $this->categoryRepository->findById($id, ['parent']);

        if (!$category) throw new CategoryNotFoundException();

        return $category;
    }
}
