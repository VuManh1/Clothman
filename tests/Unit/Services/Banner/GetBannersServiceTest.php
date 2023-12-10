<?php

namespace Tests\Unit\Services\Banner;

use App\DTOs\Banners\BannerParamsDto;
use App\Exceptions\Banners\BannerNotFoundException;
use App\Models\Banner;
use App\Services\Banners\Implementations\GetBannersServiceImpl;
use App\Services\Banners\Interfaces\GetBannersService;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class GetBannersServiceTest extends TestCase
{
    private GetBannersService $getBannersService;

    public function setUp(): void
    {
        parent::setUp();

        $this->getBannersService = App::make(GetBannersServiceImpl::class);
    }

    public function test_it_can_get_one_banner_by_ID()
    {
        $banner = Banner::factory()->create();
        $foundBanner = $this->getBannersService->getBannerById($banner->id); 

        $this->assertEquals($foundBanner->id, $banner->id);
    }

    public function test_it_throw_exception_if_ID_not_exists()
    {
        $this->assertThrows(
            fn () => $this->getBannersService->getBannerById('abc'),
            BannerNotFoundException::class
        );
    }

    public function test_it_return_paginated_banners()
    {
        Banner::factory()->count(3)->create();

        $limit = 2;
        $params = new BannerParamsDto(0, $limit, null, null, null, null);

        $banners = $this->getBannersService->getBannersByParams($params);

        $this->assertTrue($banners->count() === $limit);
    }
}
