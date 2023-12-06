<?php

namespace Tests\Unit\Services\Category;

use App\DTOs\Banners\UpdateBannerDto;
use App\Models\Banner;
use App\Services\Banners\Implementations\ManageBannersServiceImpl;
use App\Services\Banners\Interfaces\ManageBannersService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ManageBannersServiceTest extends TestCase
{
    use RefreshDatabase;

    private ManageBannersService $manageBannersService;

    public function setUp(): void
    {
        parent::setUp();

        $this->manageBannersService = App::make(ManageBannersServiceImpl::class);
    }

    public function test_it_can_update_banner()
    {
        $banner = Banner::factory()->create();
        $dto = new UpdateBannerDto(
            'New Banner', 
            'new link',
            null,
            true
        );

        $updatedBanner = $this->manageBannersService->updateBanner($banner->id, $dto);

        $this->assertInstanceOf(Banner::class, $updatedBanner);
        $this->assertEquals($updatedBanner->name, $dto->name);
    }

    public function test_it_can_delete_banner()
    {
        $banner = Banner::factory()->create();

        $result = $this->manageBannersService->deleteBanner($banner->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('banners', ['id' => $banner->id]);
    }
}
