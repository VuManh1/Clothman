<?php
 
namespace App\Exceptions;

use Exception;

/**
 * Exception thrown if trying insert an entity which is already exists in database
 */
class EntityDuplicatedException extends Exception
{
    public function __construct($entityName = "Entity")
    {
        parent::__construct("$entityName is duplicated");
    }
}