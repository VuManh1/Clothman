<?php

namespace App\Exceptions\Colors;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class ColorNotFoundException extends ModelNotFoundException
{
    public function __construct()
    {
        parent::__construct("Color was not found");
    }
}
