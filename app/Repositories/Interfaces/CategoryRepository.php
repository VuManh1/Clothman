<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Categories\CategoryParamsDto;
use App\Repositories\Interfaces\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
    public function getAllParentCategories(): Collection;

    /**
     * Get all categories that have no parent
     */
    // public function getHomeCategories(): Collection;
}
