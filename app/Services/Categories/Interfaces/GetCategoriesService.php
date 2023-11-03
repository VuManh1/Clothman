<?php

namespace App\Services\Categories\Interfaces;

/**
 * Service Interface for category to deal with Read operations
 */
interface GetCategoriesService
{
    /**
     * Get categories
     * @return mixed
     */
    public function get();
}
