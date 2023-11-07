<?php

namespace App\Providers;

use App\Services\Categories\Implementations\GetCategoriesServiceImpl;
use App\Services\Categories\Implementations\ManageCategoriesServiceImpl;
use App\Services\Colors\Implementations\GetColorsServiceImpl;
use App\Services\Categories\Interfaces\GetCategoriesService;
use App\Services\Categories\Interfaces\ManageCategoriesService;
use App\Services\Colors\Implementations\ManageColorsServiceImpl;
use App\Services\Colors\Interfaces\GetColorsService;
use App\Services\Colors\Interfaces\ManageColorsService;
use App\Services\Products\Implementations\GetProductsServiceImpl;
use App\Services\Products\Interfaces\GetProductsService;
use App\Services\Users\Implementations\ManageUsersServiceImpl;
use App\Services\Users\Interfaces\ManageUsersService;
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

        // color services
        $this->app->bind(GetColorsService::class, GetColorsServiceImpl::class);
        $this->app->bind(ManageColorsService::class, ManageColorsServiceImpl::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
