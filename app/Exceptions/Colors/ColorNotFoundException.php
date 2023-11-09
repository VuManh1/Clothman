<?php

namespace App\Exceptions\Colors;

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Exception thrown if trying to get a color which not exists in database
 */
class ColorNotFoundException extends ModelNotFoundException
{
    public function __construct()
    {
        parent::__construct("Color was not found");
    }
}
