<?php

namespace App\Exceptions\Colors;

use App\Exceptions\EntityDuplicatedException;

/**
 * Exception thrown if trying insert a color which name or hex code is already exists in database
 */
class ColorDuplicatedException extends EntityDuplicatedException
{
    public function __construct()
    {
        parent::__construct("Color");
    }
}
