<?php

namespace App\Services\Categories\Implementations;

use App\DTOs\Categories\CreateCategoryDto;
use App\DTOs\Categories\UpdateCategoryDto;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Categories\Interfaces\ManageCategoriesService;

class ManageCategoriesServiceImpl implements ManageCategoriesService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function createCategory($id, CreateCategoryDto $createCategoryDto) {
        
    }

    public function updateCategory($id, UpdateCategoryDto $updateCategoryDto) {

    }

    public function deleteCategory($id) {

    }
}
