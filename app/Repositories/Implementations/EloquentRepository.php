<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function getAll(): Collection {
        return $this->model->all();
    }

    public function first(array $filters, array $includes = null): ?Model {
        if ($includes) {
            return $this->model->with($includes)->firstWhere($filters);
        }

        return $this->model->firstWhere($filters);
    }

    public function findById(string $id, array $includes = null): ?Model {
        if ($includes) {
            return $this->model->with($includes)->find($id);
        }

        return $this->model->find($id);
    }

    public function find(int $page, int $limit, array $filters = null, array $sorts = null, array $includes = null): LengthAwarePaginator {
        $query = $this->model->query();

        if ($includes) {
            $query->with($includes);
        }

        if ($filters && !empty($filters)) {
            // wrap filters in array if it is Associative arrays
            if (! is_array(reset($filters))) {
                $filters = [$filters];
            }

            foreach ($filters as $filter) {
                $column = $filter['column'];
                $operator = isset($filter['operator']) ? $filter['operator'] : null;
                $value = $filter['value'];

                if ($operator) {
                    $query->where($column, $operator, $value);
                } else {
                    $query->where($column, $value);
                }
            }
        }

        if ($sorts && !empty($sorts)) {
            // wrap sorts in array if it is Associative arrays
            if (! is_array(reset($sorts))) {
                $sorts = [$sorts];
            }

            foreach ($sorts as $sort) {
                $by = isset($sort['by']) ? $sort['by'] : "asc";
                $query->orderBy($sort['column'], $by);
            }
        }

        $count = $query->count();
        $items = $query->forPage($page, $limit)->get();

        return new LengthAwarePaginator($items, $count, $limit, $page); 
    }

    public function create(array $attributes): Model {
        return $this->model->create($attributes);
    }

    public function update(string $id, array $attributes): Model {
        $result = $this->findById($id);
        
        if (!$result) throw new ModelNotFoundException();

        $result->update($attributes);

        return $result;
    }

    public function delete(string $id): bool {
        $result = $this->findById($id);

        if (!$result) throw new ModelNotFoundException();

        $result->delete();

        return true;
    }
}