<?php
 
namespace App\Exceptions\Products;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductNotFoundException extends ModelNotFoundException
{
    public function __construct()
    {
        parent::__construct("Product was not found");
    }
}