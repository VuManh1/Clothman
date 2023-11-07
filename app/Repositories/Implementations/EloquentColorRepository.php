<?php

namespace App\Repositories\Implementations;

use App\Models\Color;
use App\Repositories\Interfaces\ColorRepository;

class EloquentColorRepository extends EloquentRepository implements ColorRepository
{
    public function __construct() {
        parent::__construct(Color::class);
    }
}
