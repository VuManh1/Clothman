<?php

namespace App\Exceptions\Banners;

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Exception thrown if trying to get a Banner which not exists in database
 */
class BannerNotFoundException extends ModelNotFoundException
{
    public function __construct()
    {
        parent::__construct("Banner was not found");
    }
}
