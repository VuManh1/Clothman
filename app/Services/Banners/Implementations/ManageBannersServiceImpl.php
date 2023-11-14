<?php

namespace App\Services\Banners\Implementations;

use App\DTOs\Banners\CreateBannerDto;
use App\DTOs\Banners\UpdateBannerDto;
use App\Exceptions\Banners\BannerNotFoundException;
use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepository;
use App\Services\Banners\Interfaces\ManageBannersService;
use App\Services\Upload\Interfaces\UploadService;
use App\Utils\UploadFolder;

class ManageBannersServiceImpl implements ManageBannersService
{
    public function __construct(
        private BannerRepository $bannerRepository,
        private UploadService $uploadService
    ) {}

    public function createBanner(CreateBannerDto $createBannerDto): Banner {
        $uploadResult = $this->uploadService->uploadFile($createBannerDto->image, [
            'folder' => UploadFolder::IMAGE_BANNER_PATH,
        ]);

        return $this->bannerRepository->create([
            "name"=> $createBannerDto->name,
            "link"=> $createBannerDto->link,
            'image_url' => $uploadResult['path'],
        ]);
    }

    public function updateBanner($id, UpdateBannerDto $updateBannerDto): Banner {
        $data = [
            "name"=> $updateBannerDto->name,
            "link"=> $updateBannerDto->link,
            'is_active' => $updateBannerDto->is_active,
        ];

        // if have an image, upload it and assign path to $data
        $uploadResult = null;
        if ($updateBannerDto->image) {
            $uploadResult = $this->uploadService->uploadFile($updateBannerDto->image, [
                'folder' => UploadFolder::IMAGE_BANNER_PATH
            ]);

            $data['image_url'] = $uploadResult['path'];
        }

        return $this->bannerRepository->update($id, $data);
    }

    public function deleteBanner($id): bool {
        $banner = $this->bannerRepository->findById($id);

        if (!$banner) {
            throw new BannerNotFoundException();
        }

        if ($banner->image_url) {
            $this->uploadService->deleteFile($banner->image_url);
        }

        return $this->bannerRepository->delete($id);
    }
}
