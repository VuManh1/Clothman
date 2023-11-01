<?php

namespace App\Repositories\Interfaces;

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
     * @param $id
     * @return mixed
     */
    public function find($filters = []);

    /**
     * Create an entity
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update an entity
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete an entity
     * @param $id
     * @return mixed
     */
    public function delete($id);
}