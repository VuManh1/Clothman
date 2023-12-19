<?php

namespace Tests\Unit\Repositories;

use App\Models\Banner;
use App\Repositories\Implementations\EloquentBannerRepository;
use App\Repositories\Interfaces\BannerRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class BannerRepositoryTest extends TestCase 
{
    use RefreshDatabase;

    private BannerRepository $bannerRepository;

    public function setUp(): void {
        parent::setUp();
        $this->bannerRepository = new EloquentBannerRepository;
    }

    public function test_it_can_find_one_banner()
    {
        $banner = Banner::factory()->create();
        $foundBanner = $this->bannerRepository->findById($banner->id);

        $this->assertEquals($foundBanner->id, $banner->id);
    }

    /**
     * test get all banners which is_active is True
     *
     * @return void
     */
    public function test_it_return_all_active_banners()
    {
        Banner::factory()->count(2)->create();
        $activeBanners = $this->bannerRepository->findByIsActive(true);
        
        $this->assertTrue($activeBanners->every(function ($value, int $key) {
            return $value->is_active === 1;
        }));
    }

    public function test_it_can_create_banner()
    {
        $data = [
            'name' => 'Banner 1',
            'image_url' => 'image url',
        ];

        $banner = $this->bannerRepository->create($data);

        $this->assertTrue($banner instanceof Banner);
        $this->assertEquals($banner->name, $data['name']);
        $this->assertEquals($banner->image_url, $data['image_url']);
    }

    public function test_it_can_update_banner()
    {
        $banner = Banner::factory()->create();
        $newData = [
            'name' => 'New banner name',
            'image_url' => 'New image',
        ];

        $updatedBanner = $this->bannerRepository->update($banner->id, $newData);

        $this->assertEquals($updatedBanner->name, $newData['name']);
        $this->assertEquals($updatedBanner->image_url, $newData['image_url']);
    }

    public function test_it_can_delete_banner()
    {
        $banner = Banner::factory()->create();
        $this->bannerRepository->delete($banner->id);

        $this->assertNull($this->bannerRepository->findById($banner->id));
    }  
}
