<?php

namespace Tests\Unit\Services\Category;

use App\DTOs\Categories\CreateCategoryDto;
use App\DTOs\Categories\UpdateCategoryDto;
use App\Models\Category;
use App\Services\Categories\Implementations\ManageCategoriesServiceImpl;
use App\Services\Categories\Interfaces\ManageCategoriesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ManageCategoriesServiceTest extends TestCase
{
    use RefreshDatabase;

    private ManageCategoriesService $manageCategoriesService;

    public function setUp(): void
    {
        parent::setUp();

        $this->manageCategoriesService = App::make(ManageCategoriesServiceImpl::class);
    }

    // public function test_it_can_create_category()
    // {
    //     Storage::fake('images/category_banners');

    //     $dto = new CreateCategoryDto(
    //         'Quan', 
    //         'desc',
    //         null,
    //         UploadedFile::fake()->image('fake-banner.jpg'),
    //     );

    //     $category = $this->manageCategoriesService->createCategory($dto);

    //     $this->assertInstanceOf(Category::class, $category);
    //     $this->assertFileExists(
    //         Storage::path('images/category_banners/fake-banner.jpg')
    //     );
    // }

    public function test_it_can_update_category()
    {
        $category = Category::factory()->create();
        $dto = new UpdateCategoryDto(
            'New Quan', 
            'new desc',
            null,
            null,
            false
        );

        $updatedCategory = $this->manageCategoriesService->updateCategory($category->id, $dto);

        $this->assertInstanceOf(Category::class, $updatedCategory);
        $this->assertEquals($updatedCategory->name, $dto->name);
    }

    public function test_it_can_delete_category()
    {
        $category = Category::factory()->create();

        $result = $this->manageCategoriesService->deleteCategory($category->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }
}
