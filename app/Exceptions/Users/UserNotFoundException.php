<?php
 
namespace App\Exceptions\Users;

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Exception thrown if trying to get an user which not exists in database
 */
class UserNotFoundException extends ModelNotFoundException
{
    public function __construct()
    {
        parent::__construct("User was not found");
    }
}