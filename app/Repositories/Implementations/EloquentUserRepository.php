<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;

class EloquentUserRepository extends EloquentRepository implements UserRepository
{
    public function __construct() {
        parent::__construct(User::class);
    }

    public function findByEmail(string $email): ?User {
        return $this->model->where('email', $email)->first();
    }
}
