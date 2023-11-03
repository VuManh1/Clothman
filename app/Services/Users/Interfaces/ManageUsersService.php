<?php

namespace App\Services\Users\Interfaces;

use App\DTOs\Users\UpdateUserDto;

/**
 * Service Interface for users to deal with CUD (Create, Update, Delete) operations
 */
interface ManageUsersService
{
    /**
     * Update an account
     */
    public function updateUserInformation($id, UpdateUserDto $updateUserDto);

}
