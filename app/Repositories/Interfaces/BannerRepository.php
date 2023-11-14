<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\Repository;

/**
 * Repository for Banner entity
 */
interface BannerRepository extends Repository
{
    /**
     * Check if a Banner have at least one child
     * @param string $id (id of Banner to check)
     */
    public function checkChildExists(string $id): bool;
}
