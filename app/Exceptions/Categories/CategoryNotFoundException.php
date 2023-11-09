<?php
 
namespace App\Exceptions\Categories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Exception thrown if trying to get a category which not exists in database
 */
class CategoryNotFoundException extends ModelNotFoundException
{
    public function __construct()
    {
        parent::__construct("Category was not found");
    }
}