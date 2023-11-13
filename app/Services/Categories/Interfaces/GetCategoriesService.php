<?php

namespace App\Services\Categories\Interfaces;

use App\DTOs\Categories\CategoryParamsDto;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service Interface for category to deal with Read operations
 */
interface GetCategoriesService
{
    /**
     * Get categories
     */
    public function getCategories(CategoryParamsDto $params = null);

    /**
     * Get one category by ID
     * @return \App\Models\Category
     * @throws \App\Exceptions\Categories\CategoryNotFoundException
     */
    public function getCategoryById(string $id): Category;

    /**
     * Get all categories that have no parent
     */
    public function getAllParentCategories(): Collection;
}
