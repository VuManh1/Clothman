<?php
 
namespace App\Exceptions\Categories;

use Exception;

class CategoryCanNotDeleteException extends Exception
{
    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}