<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Categories\CategoryParamsDto;
use App\Models\Category;
use App\Repositories\Interfaces\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Repository for Category entity
 */
interface CategoryRepository extends Repository
{
    /**
     * Find one category by slug
     */
    public function findBySlug(string $slug, array $includes = null): ?Category;

    /**
     * Find categories by CategoryParamsDto
     */
    public function findByParams(CategoryParamsDto $params): LengthAwarePaginator;

    /**
     * Check if a category have at least one child
     * @param string $id (id of category to check)
     */
    public function checkChildExists(string $id): bool;

    /**
     * Find categories by parent id
     */
    public function findByParentId(?string $parentId, array $includes = null): Collection;

    /**
     * Get home categories 
     * 
     * @param int $productsCount (amount of products will be loaded with category)
     */
    public function getHomeCategories(int $productsCount): Collection;
}
