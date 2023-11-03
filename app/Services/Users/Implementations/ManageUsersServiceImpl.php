<?php

namespace App\Services\Users\Implementations;

use App\DTOs\Users\UpdateUserDto;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Users\Interfaces\ManageUsersService;

class ManageUsersServiceImpl implements ManageUsersService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function updateUserInformation($id, UpdateUserDto $updateUserDto) {
        return $this->userRepository->update($id, [
            'name' => $updateUserDto->name,
            'phone_number' => $updateUserDto->phoneNumber,
            'address' => $updateUserDto->address,
        ]);
    }
}
