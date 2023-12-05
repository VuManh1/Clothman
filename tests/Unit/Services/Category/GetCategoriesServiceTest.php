<?php

namespace Tests\Unit\Services\Category;

use App\DTOs\Categories\CategoryParamsDto;
use App\Exceptions\Categories\CategoryNotFoundException;
use App\Models\Category;
use App\Services\Categories\Implementations\GetCategoriesServiceImpl;
use App\Services\Categories\Interfaces\GetCategoriesService;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class GetCategoriesServiceTest extends TestCase
{
    private GetCategoriesService $getCategoriesService;

    public function setUp(): void
    {
        parent::setUp();

        $this->getCategoriesService = App::make(GetCategoriesServiceImpl::class);
    }

    public function test_it_can_get_one_category_by_ID()
    {
        $category = Category::factory()->create();
        $foundCategory = $this->getCategoriesService->getCategoryById($category->id);

        $this->assertEquals($foundCategory->id, $category->id);
    }

    public function test_it_throw_exception_if_ID_not_exists()
    {
        $this->assertThrows(
            fn () => $this->getCategoriesService->getCategoryById('abc'),
            CategoryNotFoundException::class
        );
    }

    public function test_it_return_paginated_categories()
    {
        Category::factory()->count(3)->create();

        $limit = 2;
        $params = new CategoryParamsDto(0, $limit, null, null, null, null);

        $categories = $this->getCategoriesService->getCategoriesByParams($params);

        $this->assertTrue($categories->count() === $limit);
    }
}
