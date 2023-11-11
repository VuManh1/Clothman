<?php
 
namespace App\Exceptions\Products;

use Exception;

/**
 * Exception thrown if trying to delete a product which have at least one order
 */
class ProductCanNotDeleteException extends Exception
{
    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}