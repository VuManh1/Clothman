<?php

namespace App\Repositories\Implementations;

use App\Models\UserLogin;
use App\Repositories\Interfaces\UserLoginRepository;

class EloquentUserLoginRepository extends EloquentRepository implements UserLoginRepository
{
    public function __construct() {
        parent::__construct(UserLogin::class);
    }

    public function findByProvider(string $providerName, string $providerKey): ?UserLogin {
        return $this->model->where('provider_name', $providerName)
            ->where('provider_key', $providerKey)->first();
    }
}
