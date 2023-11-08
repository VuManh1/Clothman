<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface Repository
{
    /**
     * Get all entities from database
     */
    public function getAll(): Collection;

    /**
     * Get one entity by ID
     */
    public function findById(string $id, array $includes = null): ?Model;

    /**
     * Get one entity by filters
     */
    public function first(array $filters, array $includes = null): ?Model;

    /**
     * Get entities from database
     * @param int $page
     * @param int $limit
     * @param array $filters (column, operator, value) 
     * @param array $sorts (column, by)
     * @param array $includes
     */
    public function find(
        int $page, 
        int $limit, 
        array $filters = null, 
        array $sorts = null, 
        array $includes = null
    ): LengthAwarePaginator;

    /**
     * Insert an entity to database
     */
    public function create(array $attributes): Model;

    /**
     * Update an entity from database
     * @throws \ModelNotFoundException
     */
    public function update(string $id, array $attributes): Model;

    /**
     * Delete an entity from database
     * @throws \ModelNotFoundException
     */
    public function delete(string $id): bool;
}
