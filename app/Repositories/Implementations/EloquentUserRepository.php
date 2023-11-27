<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;

use App\DTOs\Users\UserParamsDto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentUserRepository extends EloquentRepository implements UserRepository
{
    public function __construct() {
        parent::__construct(User::class);
    }

    public function findByParams(UserParamsDto $params): LengthAwarePaginator {
        $query = $this->model->query();

        if ($params->keyword) {
            $query->where("name", "LIKE", "%".$params->keyword."%");
        }
        if ($params->isLocked !== null) {
            $query->where('is_locked', $params->isLocked);
        }
        if ($params->role !== null) {
            $query->where('role', $params->role);
        }

        if ($params->sortColumn) {
            $query->orderBy($params->sortColumn, $params->sortOrder ?? "asc");
        }

        return $this->toPaginator($query, $params->page, $params->limit);
    }

    public function findByEmail(string $email): ?User {
        return $this->model->where('email', $email)->first();
    }

    public function countByCreatedAt(string $date): int {
        return $this->model->whereDate('created_at', $date)->count();
    }
}
