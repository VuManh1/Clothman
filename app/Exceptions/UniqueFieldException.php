<?php
 
namespace App\Exceptions;

use Exception;

/**
 * Exception thrown if trying to insert a unique field to database
 */
class UniqueFieldException extends Exception
{
    public function __construct()
    {
        parent::__construct("Unique field constraint violation");
    }
}