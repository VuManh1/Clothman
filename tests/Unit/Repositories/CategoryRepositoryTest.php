<?php

namespace Tests\Unit\Repositories;

use App\Models\Category;
use App\Repositories\Implementations\EloquentCategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test get all categories
     *
     * @return void
     */
    public function test_return_all_categories()
    {
        $categoryRepository = new EloquentCategoryRepository;

        $data = $categoryRepository->getAll();
        $this->assertTrue(is_a($data, 'Illuminate\Support\Collection'));
    }

    /**
     * test insert one category to database
     *
     * @return void
     */
    public function test_create_category()
    {
        $categoryRepository = new EloquentCategoryRepository;
        $data = [
            'name' => 'Quần',
            'slug' => 'quan',
            'banner_url' => ''
        ];

        $result = $categoryRepository->create($data);

        $this->assertTrue($result instanceof Category);
    }
}
