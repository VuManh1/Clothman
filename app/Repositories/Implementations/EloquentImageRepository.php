<?php

namespace App\Repositories\Implementations;

use App\Models\Image;
use App\Repositories\Interfaces\ImageRepository;

class EloquentImageRepository extends EloquentRepository implements ImageRepository
{
    public function __construct() {
        parent::__construct(Image::class);
    }
}
