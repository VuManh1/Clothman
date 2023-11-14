<?php

namespace App\Services\Categories\Interfaces;

use App\DTOs\Categories\CategoryParamsDto;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Service Interface for category to deal with Read operations
 */
interface GetCategoriesService
{
    /** Get all categories */
    public function getAllCategories(): Collection;

    /**
     * Get categories
     */
    public function getCategoriesByParams(CategoryParamsDto $params): LengthAwarePaginator;

    /**
     * Get one category by ID
     * @return \App\Models\Category
     * @throws \App\Exceptions\Categories\CategoryNotFoundException
     */
    public function getCategoryById(string $id, array $includes = null): Category;

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
