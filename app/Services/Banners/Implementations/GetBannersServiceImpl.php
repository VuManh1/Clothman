<?php

namespace App\Services\Banners\Implementations;

use App\DTOs\Banners\BannerParamsDto;
use App\Exceptions\Banners\BannerNotFoundException;
use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepository;
use App\Services\Banners\Interfaces\GetBannersService;

class GetBannersServiceImpl implements GetBannersService
{
    public function __construct(
        private BannerRepository $bannerRepository
    ) {}

    public function getBanners(BannerParamsDto $params = null) {


        if (!$params) {
            return $this->bannerRepository->getAll();
        }

        $filters = null;
        if ($params->keyword) {
            $filters = [
                'column' => 'name',
                'operator' => 'LIKE',
                'value' => '%'.$params->keyword.'%'
            ];
        }

        $sorts = null;
        if ($params->sort) {
            $sorts = ['column' => $params->sort, 'by' => $params->by];
        }

        return $this->bannerRepository->find(
            $params->page,
            $params->limit,
            $filters,
            $sorts
        );
    }

    public function getBannerById(string $id): Banner {
        $banner = $this->bannerRepository->findById($id);

        if (!$banner) throw new BannerNotFoundException();

        return $banner;
    }
}
