<?php
 
namespace App\Exceptions\Categories;

use App\Exceptions\EntityDuplicatedException;

/**
 * Exception thrown if trying insert a category which name is already exists in database
 */
class CategoryDuplicatedException extends EntityDuplicatedException
{
    public function __construct()
    {
        parent::__construct("Category");
    }
}