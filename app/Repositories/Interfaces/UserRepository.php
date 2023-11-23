<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Repositories\Interfaces\Repository;

/**
 * Repository for User entity
 */
interface UserRepository extends Repository
{
    public function findByEmail(string $email): ?User;
}
