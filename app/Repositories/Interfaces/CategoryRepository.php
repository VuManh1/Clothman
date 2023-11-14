<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Categories\CategoryParamsDto;
use App\Repositories\Interfaces\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Repository for Category entity
 */
interface CategoryRepository extends Repository
{
    /**
     * Get categories by CategoryParamsDto
     */
    public function getCategoriesByParams(CategoryParamsDto $params): LengthAwarePaginator;

    /**
     * Check if a category have at least one child
     * @param string $id (id of category to check)
     */
    public function checkChildExists(string $id): bool;

    /**
     * Get all categories that have no parent
     */
    public function getAllParentCategories(array $includes = null): Collection;

    /**
     * Get home categories 
     * 
     * @param int $productsCount (amount of products will be loaded with category)
     */
    public function getHomeCategories(int $productsCount): Collection;
}
