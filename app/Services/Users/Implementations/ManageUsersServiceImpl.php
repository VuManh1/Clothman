<?php

namespace App\Services\Users\Implementations;

use App\DTOs\Users\ChangePasswordDto;
use App\DTOs\Users\UpdateUserDto;
use App\DTOs\Users\CreateStaffDto;
use App\Exceptions\UniqueFieldException;
use App\Exceptions\Users\PasswordNotMatchException;
use App\Exceptions\Users\UserNotFoundException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Users\Interfaces\ManageUsersService;
use App\Utils\Role;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageUsersServiceImpl implements ManageUsersService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function createStaff(CreateStaffDto $createStaffDto): User {
        try {
            return $this->userRepository->create([
                "name"=> $createStaffDto->name,
                "email"=> $createStaffDto->email,
                "password"=> Hash::make($createStaffDto->password),
                "role"=> "STAFF",
                "email_verified_at" => Carbon::now()
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            throw new UniqueFieldException("Email đã tồn tại");
        }
    }

    public function updateUserInformation($id, UpdateUserDto $updateUserDto): User {
        return $this->userRepository->update($id, [
            'name' => $updateUserDto->name,
            'phone_number' => $updateUserDto->phoneNumber,
            'address' => $updateUserDto->address,
        ]);
    }

    public function toggleLock($id): bool {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if ($user->role === Role::ADMIN) {
            throw new AuthorizationException("Perform actions to ADMIN is not allowed!");
        }

        $user = $this->userRepository->update($id, [
            'is_locked' => $user->is_locked ? 0 : 1
        ]);

        return $user->is_locked;
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
