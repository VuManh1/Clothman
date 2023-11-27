<?php

namespace App\Services\Users\Implementations;

use App\DTOs\Users\UserParamsDto;
use App\Exceptions\Users\UserNotFoundException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Users\Interfaces\GetUsersService;
use Illuminate\Pagination\LengthAwarePaginator;

class GetUsersServiceImpl implements GetUsersService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function getUsersByParams(UserParamsDto $params): LengthAwarePaginator {
        return $this->userRepository->findByParams($params);
    }

    public function getUserById(string $id): User {
        $user = $this->userRepository->findById($id);

        if (!$user) throw new UserNotFoundException();

        return $user;
    }
}
