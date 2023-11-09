<?php

namespace App\Exceptions\Colors;

use Exception;

/**
 * Exception thrown if trying insert a color which name or hex code is already exists in database
 */
class ColorDuplicateException extends Exception
{
    public function __construct()
    {
        parent::__construct("Color name or hex code is duplicate");
    }
}
