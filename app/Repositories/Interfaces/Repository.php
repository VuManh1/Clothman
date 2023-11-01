<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface Repository
{
    /**
     * Get all entities
     * @return mixed
     */
    public function getAll();

    /**
     * Get one entity
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Get entities
     * @return LengthAwarePaginator
     */
    public function find(array $filters, array $sorts, int $limit, array $includes): LengthAwarePaginator;

    /**
     * Create an entity
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update an entity
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete an entity
     * @param $id
     * @return mixed
     */
    public function delete($id);
}