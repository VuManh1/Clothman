<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class EloquentRepository implements Repository
{
    protected Model $model;

    public function __construct($model) {
        $this->setModel($model);
    }

    private function setModel($model) {
        $this->model = app()->make($model);
    }

    public function getAll() {
        return $this->model->all();
    }

    public function findById($id) {
        $result = $this->model->find($id);

        return $result;
    }

    public function find(array $filters, array $sorts, int $limit, array $includes): LengthAwarePaginator {
        $query = $this->model->query();

        return $query->paginate($limit); 
    }

    public function create(array $attributes) {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes) {
        $result = $this->findById($id);
        
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id) {
        $result = $this->findById($id);

        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}