<?php

namespace App\Services\Categories\Interfaces;

use App\DTOs\Categories\CategoryParamsDto;
use App\Models\Category;
use Illuminate\Support\Collection;

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
     * Get all parent categories include child categories
     */
    public function getParentCategoriesWithChilds(): Collection;

    /**
     * Get home categories
     * 
     * @param int $productsCount (amount of products loaded with category)
     */
    public function getHomeCategories(int $productsCount): Collection;
}
