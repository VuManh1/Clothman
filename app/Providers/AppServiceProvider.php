<?php

namespace App\Providers;

use App\Services\Categories\Implementations\GetCategoriesServiceImpl;
use App\Services\Categories\Implementations\ManageCategoriesServiceImpl;
use App\Services\Categories\Interfaces\GetCategoriesService;
use App\Services\Categories\Interfaces\ManageCategoriesService;
use App\Services\Products\Implementations\GetProductsServiceImpl;
use App\Services\Products\Interfaces\GetProductsService;
use App\Services\Upload\Implementations\LocalUploadService;
use App\Services\Upload\Interfaces\UploadService;
use App\Services\Users\Implementations\ManageUsersServiceImpl;
use App\Services\Users\Interfaces\ManageUsersService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // User Services
        $this->app->bind(ManageUsersService::class, ManageUsersServiceImpl::class);

        // Product Services
        $this->app->bind(GetProductsService::class, GetProductsServiceImpl::class);

        // Category Services
        $this->app->bind(GetCategoriesService::class, GetCategoriesServiceImpl::class);
        $this->app->bind(ManageCategoriesService::class, ManageCategoriesServiceImpl::class);

        // Upload Service
        $this->app->bind(UploadService::class, LocalUploadService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
