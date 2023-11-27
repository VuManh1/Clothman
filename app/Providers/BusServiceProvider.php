<?php

namespace App\Providers;

use App\Services\Banners\Implementations\GetBannersServiceImpl;
use App\Services\Banners\Implementations\ManageBannersServiceImpl;
use App\Services\Banners\Interfaces\GetBannersService;
use App\Services\Banners\Interfaces\ManageBannersService;
use App\Services\Users\Implementations\GetUsersServiceImpl;
use App\Services\Users\Implementations\ManageUsersServiceImpl;
use App\Services\Users\Interfaces\GetUsersService;
use App\Services\Users\Interfaces\ManageUsersService;
use App\Services\Cart\Implementations\CartServiceImpl;
use App\Services\Cart\Interfaces\CartService;
use App\Services\Categories\Implementations\GetCategoriesServiceImpl;
use App\Services\Categories\Implementations\ManageCategoriesServiceImpl;
use App\Services\Colors\Implementations\GetColorsServiceImpl;
use App\Services\Categories\Interfaces\GetCategoriesService;
use App\Services\Categories\Interfaces\ManageCategoriesService;
use App\Services\Checkout\Implementations\CheckoutServiceImpl;
use App\Services\Checkout\Interfaces\CheckoutService;
use App\Services\Colors\Implementations\ManageColorsServiceImpl;
use App\Services\Colors\Interfaces\GetColorsService;
use App\Services\Colors\Interfaces\ManageColorsService;
use App\Services\Orders\Implementations\OrdersServiceImpl;
use App\Services\Orders\Interfaces\OrdersService;
use App\Services\Payment\Implementations\CodPaymentService;
use App\Services\Payment\Interfaces\PaymentService;
use App\Services\Products\Implementations\GetProductsServiceImpl;
use App\Services\Products\Implementations\ManageProductImagesServiceImpl;
use App\Services\Products\Implementations\ManageProductsServiceImpl;
use App\Services\Products\Implementations\ManageProductVariantsServiceImpl;
use App\Services\Products\Interfaces\GetProductsService;
use App\Services\Products\Interfaces\ManageProductImagesService;
use App\Services\Products\Interfaces\ManageProductsService;
use App\Services\Products\Interfaces\ManageProductVariantsService;
use App\Services\Upload\Implementations\LocalUploadService;
use App\Services\Upload\Interfaces\UploadService;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
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
        $this->app->bind(ManageProductImagesService::class, ManageProductImagesServiceImpl::class);

        // Category Services
        $this->app->bind(GetCategoriesService::class, GetCategoriesServiceImpl::class);
        $this->app->bind(ManageCategoriesService::class, ManageCategoriesServiceImpl::class);

        // color services
        $this->app->bind(GetColorsService::class, GetColorsServiceImpl::class);
        $this->app->bind(ManageColorsService::class, ManageColorsServiceImpl::class);

        //Banner services
        $this->app->bind(GetBannersService::class, GetBannersServiceImpl::class);
        $this->app->bind(ManageBannersService::class, ManageBannersServiceImpl::class);

        //User services
        $this->app->bind(ManageUsersService::class, ManageUsersServiceImpl::class);
        $this->app->bind(GetUsersService::class, GetUsersServiceImpl::class);


        // Order services
        $this->app->bind(OrdersService::class, OrdersServiceImpl::class);

        // Payment services
        $this->app->bind(PaymentService::class, CodPaymentService::class);

        // Cart services
        $this->app->bind(CartService::class, CartServiceImpl::class);

        // Checkout services
        $this->app->bind(CheckoutService::class, CheckoutServiceImpl::class);

        // Upload Service
        $this->app->bind(UploadService::class, LocalUploadService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
