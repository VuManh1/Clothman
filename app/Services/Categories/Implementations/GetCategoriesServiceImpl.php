<?php

namespace App\Services\Categories\Implementations;

use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Categories\Interfaces\GetCategoriesService;

class GetCategoriesServiceImpl implements GetCategoriesService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function get() {
        return $this->categoryRepository->getAll();
    }
}
