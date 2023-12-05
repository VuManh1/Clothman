<?php

namespace Tests\Unit\Repositories;

use App\Models\Category;
use App\Repositories\Implementations\EloquentCategoryRepository;
use App\Repositories\Interfaces\CategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private CategoryRepository $categoryRepository;

    public function setUp(): void {
        parent::setUp();
        $this->categoryRepository = new EloquentCategoryRepository;
    }

    public function test_it_can_find_one_category()
    {
        $category = Category::factory()->create();
        $foundCategory = $this->categoryRepository->findById($category->id);

        $this->assertEquals($foundCategory->id, $category->id);
    }

    public function test_it_can_create_category()
    {
        $data = [
            'name' => 'Quan',
            'slug' => 'quan',
            'banner_url' => 'banner'
        ];

        $category = $this->categoryRepository->create($data);

        $this->assertTrue($category instanceof Category);
        $this->assertEquals($category->name, $data['name']);
        $this->assertEquals($category->banner_url, $data['banner_url']);
    }

    public function test_it_can_update_category()
    {
        $category = Category::factory()->create();
        $newData = [
            'name' => 'Quan',
            'slug' => 'quan',
            'banner_url' => 'banner'
        ];

        $updatedCategory = $this->categoryRepository->update($category->id, $newData);

        $this->assertEquals($updatedCategory->name, $newData['name']);
        $this->assertEquals($updatedCategory->banner_url, $newData['banner_url']);
    }

    public function test_it_can_soft_delete_category()
    {
        $category = Category::factory()->create();
        $this->categoryRepository->delete($category->id);

        $this->assertSoftDeleted('categories', [
            'id' => $category->id,
        ]);
    }
}
