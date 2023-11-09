<?php
 
namespace App\Exceptions\Categories;

use Exception;

/**
 * Exception thrown if trying to delete a category which have at least one child category
 */
class CategoryCanNotDeleteException extends Exception
{
    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}