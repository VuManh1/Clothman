<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Banners\Interfaces\GetBannersService;
use App\Services\Categories\Interfaces\GetCategoriesService;
use App\Services\Products\Interfaces\GetProductsService;

class HomeController extends Controller
{
    private $PRODUCTS_PER_SECTION = 8;

    public function __construct(
        private GetProductsService $getProductsService,
        private GetCategoriesService $getCategoriesService,
        private GetBannersService $getBannersService
    ) {
        
    }

    /**
     * Show the home page view
     */
    public function index() {
        $banners = $this->getBannersService->getAllActiveBanners();
        $latestProducts = $this->getProductsService->getLatestProducts($this->PRODUCTS_PER_SECTION);
        $topSellingProducts = $this->getProductsService->getTopSellingProducts($this->PRODUCTS_PER_SECTION, 'week');
        $homeCategories = $this->getCategoriesService->getHomeCategories($this->PRODUCTS_PER_SECTION);

        return view('home', compact('banners', 'latestProducts', 'homeCategories', 'topSellingProducts'));
    }
}
