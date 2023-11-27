<?php

namespace App\Services\Banners\Implementations;

use App\DTOs\Banners\BannerParamsDto;
use App\Exceptions\Banners\BannerNotFoundException;
use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepository;
use App\Services\Banners\Interfaces\GetBannersService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GetBannersServiceImpl implements GetBannersService
{
    public function __construct(
        private BannerRepository $bannerRepository
    ) {}

    public function getBannersByParams(BannerParamsDto $params): LengthAwarePaginator {
        return $this->bannerRepository->findByParams($params);
    }

    public function getAllActiveBanners(): Collection {
        return $this->bannerRepository->findByIsActive(true);
    }

    public function getBannerById(string $id): Banner {
        $banner = $this->bannerRepository->findById($id);

        if (!$banner) throw new BannerNotFoundException();

        return $banner;
    }
}
