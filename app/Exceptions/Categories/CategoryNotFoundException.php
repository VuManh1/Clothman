<?php
 
namespace App\Exceptions\Categories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryNotFoundException extends ModelNotFoundException
{
    public function __construct()
    {
        parent::__construct("Category was not found");
    }
}