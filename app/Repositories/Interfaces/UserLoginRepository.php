<?php

namespace App\Repositories\Interfaces;

use App\Models\UserLogin;
use App\Repositories\Interfaces\Repository;

/**
 * Repository for UserLogin entity
 */
interface UserLoginRepository extends Repository
{
    public function findByProvider(string $providerName, string $providerKey): ?UserLogin;
}
