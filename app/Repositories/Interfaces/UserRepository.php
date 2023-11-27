<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\DTOs\Users\UserParamsDto;
use App\Repositories\Interfaces\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Repository for User entity
 */
interface UserRepository extends Repository
{
    public function findByParams(UserParamsDto $params): LengthAwarePaginator;

    /**
     * Get one user by email
     */
    public function findByEmail(string $email): ?User;

    /**
     * Count all users by created_at field
     */
    public function countByCreatedAt(string $date): int;
}
