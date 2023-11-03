<?php

namespace App\Services\Categories\Interfaces;

use App\DTOs\Categories\CreateCategoryDto;
use App\DTOs\Categories\UpdateCategoryDto;

/**
 * Service Interface for categories to deal with CUD (Create, Update, Delete) operations
 */
interface ManageCategoriesService
{
    /**
     * Create a category
     */
    public function createCategory($id, CreateCategoryDto $createCategoryDto);

    /**
     * Update a category
     */
    public function updateCategory($id, UpdateCategoryDto $updateCategoryDto);

    /**
     * Delete a category
     */
    public function deleteCategory($id);
}
