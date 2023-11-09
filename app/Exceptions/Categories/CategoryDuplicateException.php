<?php
 
namespace App\Exceptions\Categories;

use Exception;

/**
 * Exception thrown if trying insert a category which name is already exists in database
 */
class CategoryDuplicateException extends Exception
{
    public function __construct()
    {
        parent::__construct("Category name is duplicate");
    }
}