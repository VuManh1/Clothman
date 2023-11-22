<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Base repository interface for all Entities
 */
interface Repository
{
    /**
     * Get all entities from database
     * 
     * @return mixed
     */
    public function getAll();

    /**
     * Get one entity by ID
     * 
     * @return mixed
     */
    public function findById(string $id, array $includes = null);

    /**
     * Get entities from database
     * @param int $page
     * @param int $limit
     * @param array $sorts (column, order)
     * @param array $includes
     */
    public function get(
        int $page, 
        int $limit, 
        array $sorts = null, 
        array $includes = null
    ): LengthAwarePaginator;

    /**
     * Insert an entity to database
     * 
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update an entity from database
     * 
     * @return mixed
     * @throws \RecordsNotFoundException
     */
    public function update(string $id, array $attributes);

    /**
     * Delete an entity from database
     * 
     * @throws \RecordsNotFoundException
     */
    public function delete(string $id): bool;

    /**
     * Increment column's value of an entity
     * 
     * @param string $id (ID of entity to increase)
     * @param array $columns
     */
    public function increment(string $id, array $columns): bool;

    /**
     * Decrement column's value of an entity
     * 
     * @param string $id (ID of entity to decrease)
     * @param array $columns
     */
    public function decrement(string $id, array $columns): bool;
}
