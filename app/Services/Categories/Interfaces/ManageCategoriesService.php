<?php

namespace App\Services\Categories\Interfaces;

use App\DTOs\Categories\CreateCategoryDto;
use App\DTOs\Categories\UpdateCategoryDto;
use App\Models\Category;

/**
 * Service Interface for categories to deal with CUD (Create, Update, Delete) operations
 */
interface ManageCategoriesService
{
    /**
     * Create a category
     * 
     * @throws \App\Exceptions\Categories\CategoryDuplicateException
     */
    public function createCategory(CreateCategoryDto $createCategoryDto): Category;

    /**
     * Update a category
     * 
     * @throws \App\Exceptions\Categories\CategoryDuplicateException
     */
    public function updateCategory($id, UpdateCategoryDto $updateCategoryDto): Category;

    /**
     * Delete a category
     * 
     * @throws \App\Exceptions\Categories\CategoryCanNotDeleteException
     */
    public function deleteCategory($id): bool;
}
