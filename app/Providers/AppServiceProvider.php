<?php

namespace App\Providers;

use App\Services\Banners\Implementations\GetBannersServiceImpl;
use App\Services\Banners\Implementations\ManageBannersServiceImpl;
use App\Services\Banners\Interfaces\GetBannersService;
use App\Services\Banners\Interfaces\ManageBannersService;
use App\Services\Cart\Implementations\CartServiceImpl;
use App\Services\Cart\Interfaces\CartService;
use App\Services\Categories\Implementations\GetCategoriesServiceImpl;
use App\Services\Categories\Implementations\ManageCategoriesServiceImpl;
use App\Services\Colors\Implementations\GetColorsServiceImpl;
use App\Services\Categories\Interfaces\GetCategoriesService;
use App\Services\Categories\Interfaces\ManageCategoriesService;
use App\Services\Colors\Implementations\ManageColorsServiceImpl;
use App\Services\Colors\Interfaces\GetColorsService;
use App\Services\Colors\Interfaces\ManageColorsService;
use App\Services\Products\Implementations\GetProductsServiceImpl;
use App\Services\Products\Implementations\ManageProductsServiceImpl;
use App\Services\Products\Implementations\ManageProductVariantsServiceImpl;
use App\Services\Products\Interfaces\GetProductsService;
use App\Services\Products\Interfaces\ManageProductsService;
use App\Services\Products\Interfaces\ManageProductVariantsService;
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
        $this->app->bind(ManageProductsService::class, ManageProductsServiceImpl::class);
        $this->app->bind(ManageProductVariantsService::class, ManageProductVariantsServiceImpl::class);

        // Category Services
        $this->app->bind(GetCategoriesService::class, GetCategoriesServiceImpl::class);
        $this->app->bind(ManageCategoriesService::class, ManageCategoriesServiceImpl::class);

        // color services
        $this->app->bind(GetColorsService::class, GetColorsServiceImpl::class);
        $this->app->bind(ManageColorsService::class, ManageColorsServiceImpl::class);

        //Banner services
        $this->app->bind(GetBannersService::class, GetBannersServiceImpl::class);
        $this->app->bind(ManageBannersService::class, ManageBannersServiceImpl::class);

        // Cart services
        $this->app->bind(CartService::class, CartServiceImpl::class);

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
