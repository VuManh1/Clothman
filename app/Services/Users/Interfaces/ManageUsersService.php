<?php

namespace App\Services\Users\Interfaces;

use App\DTOs\Users\ChangePasswordDto;
use App\DTOs\Users\UpdateUserDto;
use App\DTOs\Users\CreateStaffDto;
use App\Models\User;

/**
 * Service Interface for users to deal with CUD (Create, Update, Delete) operations
 */
interface ManageUsersService
{
    /**
     * Create a staff account
     */
    public function createStaff(CreateStaffDto $createStaffDto): User;

    /**
     * Update basic information of an User
     */
    public function updateUserInformation($id, UpdateUserDto $updateUserDto): User;

    /**
     * Lock user if is_locked is 0, and vice versa 
     * 
     * @return bool (true if user locked, false if unlocked)
     */
    public function toggleLock($id): bool;

    /**
     * Change password of an User
     */
    public function changePassword($id, ChangePasswordDto $changePasswordDto): bool;
}
