<?php

namespace App\Services\Banners\Interfaces;

use App\DTOs\Banners\BannerParamsDto;
use App\Models\Banner;

interface GetBannersService
{
    /**
     * Summary of getBanners
     * @param mixed $params
     */
    public function getBanners(?BannerParamsDto $params);

    /**
     * Summary of getBannerById
     * @param string $id
     * @return \App\Models\Banner
     */
    public function getBannerById(string $id): Banner;



}
