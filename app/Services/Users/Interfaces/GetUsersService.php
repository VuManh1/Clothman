<?php

namespace App\Services\Users\Interfaces;

use App\DTOs\Users\UserParamsDto;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface GetUsersService
{
    /**
     * Summary of getUsers
     * @param mixed $params
     */
    public function getUsersByParams(UserParamsDto $params): LengthAwarePaginator;

    /**
     * Summary of getUserById
     * @param string $id
     * @return \App\Models\User
     */
    public function getUserById(string $id): User;



}
