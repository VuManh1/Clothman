<?php

namespace App\Services\Banners\Interfaces;

use App\DTOs\Banners\CreateBannerDto;
use App\DTOs\Banners\UpdateBannerDto;
use App\Models\Banner;

/**
 * Service Interface for Banner to deal with CUD (Create, Update, Delete) operations
 */
interface ManageBannersService
{
    /**
     * Create a Banner
     */
    public function createBanner(CreateBannerDto $createBannerDto): Banner;

    /**
     * Update a Banner
     */
    public function updateBanner($id, UpdateBannerDto  $updateBannerDto): Banner;

    /**
     * Delete a Banner
     */
    public function deleteBanner($id): bool;
}
