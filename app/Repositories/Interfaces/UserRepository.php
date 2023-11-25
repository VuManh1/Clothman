<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Repositories\Interfaces\Repository;

/**
 * Repository for User entity
 */
interface UserRepository extends Repository
{
    /**
     * Get one user by email
     */
    public function findByEmail(string $email): ?User;

    /**
     * Count all users by created_at field
     */
    public function countByCreatedAt(string $date): int;
}
