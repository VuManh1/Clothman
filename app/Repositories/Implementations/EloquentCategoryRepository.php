<?php

namespace App\Repositories\Implementations;

use App\Exceptions\Categories\CategoryNotFoundException;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;

class EloquentCategoryRepository extends EloquentRepository implements CategoryRepository
{
    public function __construct() {
        parent::__construct(Category::class);
    }

    public function checkChildExists(string $id): bool {
        $category = $this->findById($id);

        if (!$category) throw new CategoryNotFoundException();

        return $category->childs()->exists();
    }
}
