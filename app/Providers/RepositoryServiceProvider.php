<?php

namespace App\Providers;

use App\Models\Banner;
use App\Repositories\Implementations\EloquentBannerRepository;
use App\Repositories\Implementations\EloquentCategoryRepository;
use App\Repositories\Implementations\EloquentColorRepository;
use App\Repositories\Implementations\EloquentImageRepository;
use App\Repositories\Implementations\EloquentProductRepository;
use App\Repositories\Implementations\EloquentProductVariantRepository;
use App\Repositories\Implementations\EloquentUserRepository;
use App\Repositories\Interfaces\BannerRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ColorRepository;
use App\Repositories\Interfaces\ImageRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
        $this->app->bind(ColorRepository::class, EloquentColorRepository::class);
        $this->app->bind(ImageRepository::class, EloquentImageRepository::class);
        $this->app->bind(ProductVariantRepository::class, EloquentProductVariantRepository::class);
        $this->app->bind(BannerRepository::class, EloquentBannerRepository::class);

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
