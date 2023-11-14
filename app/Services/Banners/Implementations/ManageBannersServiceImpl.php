<?php

namespace App\Services\Banners\Implementations;

use App\DTOs\Banners\CreateBannerDto;
use App\DTOs\Banners\UpdateBannerDto;
use App\Exceptions\UniqueFieldException;
use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepository;
use App\Services\Banners\Interfaces\ManageBannersService;
use App\Services\Upload\Interfaces\UploadService;
use App\Utils\UploadFolder;
use Illuminate\Support\Str;

class ManageBannersServiceImpl implements ManageBannersService
{
    public function __construct(
        private BannerRepository $BannerRepository,
        private UploadService $uploadService
    ) {}

    public function createBanner(CreateBannerDto $createBannerDto): Banner {

        $uploadResult = $this->uploadService->uploadFile($createBannerDto->image_url, [
            'folder' => UploadFolder::IMAGE_BANNER_PATH,
        ]);

        try {
            return $this->BannerRepository->create([
                "name"=> $createBannerDto->name,
                "link"=> $createBannerDto->link,
                'image_url' => $uploadResult['path'],
            ]);
        } catch (\Illuminate\Database\QueryException $th) {
            // if have any error, delete the file created previous
            $this->uploadService->deleteFile($uploadResult['path']);

            throw new UniqueFieldException();
        }
    }

    public function updateBanner($id, UpdateBannerDto $updateBannerDto): Banner {
        $slug = Str::slug($updateBannerDto->name);
        $data = [
            "name"=> $updateBannerDto->name,
            "link"=> $updateBannerDto->link,
            'is_active' => $updateBannerDto->is_active,
        ];

        // if have an image, upload it and assign path to $data
        $uploadResult = null;
        if ($updateBannerDto->image_url) {
            $uploadResult = $this->uploadService->uploadFile($updateBannerDto->image_url, [
                'folder' => UploadFolder::IMAGE_BANNER_PATH
            ]);

            $data['image_url'] = $uploadResult['path'];
        }

        try {
            return $this->BannerRepository->update($id, $data);
        } catch (\Illuminate\Database\QueryException $ex) {
            // if have any error, delete the file created previous if have
            if ($uploadResult) {
                $this->uploadService->deleteFile($uploadResult['path']);
            }

            throw new UniqueFieldException();
        }
    }

    public function deleteBanner($id): bool {
        $isChildExists = $this->BannerRepository->checkChildExists($id);

        return $this->BannerRepository->delete($id);
    }
}
