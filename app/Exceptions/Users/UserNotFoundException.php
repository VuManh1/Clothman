<?php
 
namespace App\Exceptions\Users;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserNotFoundException extends ModelNotFoundException
{
    public function __construct()
    {
        parent::__construct("User was not found");
    }
}