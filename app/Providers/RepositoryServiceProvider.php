<?php

namespace App\Providers;

use App\Repositories\Implementations\EloquentCategoryRepository;
use App\Repositories\Implementations\EloquentProductRepository;
use App\Repositories\Implementations\EloquentUserRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ProductRepository;
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
