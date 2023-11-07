<?php

namespace App\Services\Users\Interfaces;

use App\DTOs\Users\ChangePasswordDto;
use App\DTOs\Users\UpdateUserDto;
use App\Models\User;

/**
 * Service Interface for users to deal with CUD (Create, Update, Delete) operations
 */
interface ManageUsersService
{
    /**
     * Update basic information of an User
     */
    public function updateUserInformation($id, UpdateUserDto $updateUserDto): User;

    /**
     * Change password of an User
     */
    public function changePassword($id, ChangePasswordDto $changePasswordDto): bool;
}
