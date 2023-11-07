<?php

namespace App\Services\Categories\Interfaces;

use App\DTOs\Categories\CategoryParamsDto;
use App\Models\Category;

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
     */
    public function getCategoryById(string $id): Category;
}
