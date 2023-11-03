<?php

namespace App\Repositories\Implementations;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;

class EloquentCategoryRepository extends EloquentRepository implements CategoryRepository
{
    public function __construct() {
        parent::__construct(Category::class);
    }
}
