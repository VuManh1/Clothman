<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\Repository;

/**
 * Repository for Category entity
 */
interface CategoryRepository extends Repository
{
    /**
     * Check if a category have at least one child
     * @param string $id (id of category to check)
     */
    public function checkChildExists(string $id): bool;
}
