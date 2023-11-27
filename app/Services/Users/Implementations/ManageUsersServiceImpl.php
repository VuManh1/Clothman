<?php

namespace App\Services\Users\Implementations;

use App\DTOs\Users\ChangePasswordDto;
use App\DTOs\Users\UpdateUserDto;
use App\DTOs\Users\CreateStaffDto;
use App\Exceptions\Users\PasswordNotMatchException;
use App\Exceptions\Users\UserNotFoundException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Users\Interfaces\ManageUsersService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageUsersServiceImpl implements ManageUsersService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function createStaff(User $user, CreateStaffDto $createStaffDto): User {
        return $this->userRepository->create([
            "name"=> $createStaffDto->name,
            "email"=> $createStaffDto->email,
            "address"=> $createStaffDto->address,
            "phone_number"=> $createStaffDto->phone_number,
            "password"=> Hash::make($createStaffDto->password),
            "role"=> $createStaffDto->role,
        ]);

    }

    public function updateUserInformation($id, UpdateUserDto $updateUserDto): User {
        return $this->userRepository->update($id, [
            'name' => $updateUserDto->name,
            'phone_number' => $updateUserDto->phoneNumber,
            'address' => $updateUserDto->address,
        ]);
    }

    public function changePassword($id, ChangePasswordDto $changePasswordDto): bool {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!Hash::check($changePasswordDto->oldPassword, $user->password)) {
            throw new PasswordNotMatchException();
        }

        $this->userRepository->update($id, [
            'password' => Hash::make($changePasswordDto->password)
        ]);

        return true;
    }
}
