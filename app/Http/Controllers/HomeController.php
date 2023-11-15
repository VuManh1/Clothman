<?php

namespace App\Http\Controllers;

use App\Services\Categories\Interfaces\GetCategoriesService;
use App\Services\Products\Interfaces\GetProductsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $PRODUCTS_PER_SECTION = 8;

    public function __construct(
        private GetProductsService $getProductsService,
        private GetCategoriesService $getCategoriesService,
    ) {
        
    }

    /**
     * Show the home page view
     */
    public function index() {
        $latestProducts = $this->getProductsService->getLatestProducts($this->PRODUCTS_PER_SECTION);
        $topSoldProducts = $this->getProductsService->getTopSoldProducts($this->PRODUCTS_PER_SECTION);
        $homeCategories = $this->getCategoriesService->getHomeCategories($this->PRODUCTS_PER_SECTION);

        return view('home', compact('latestProducts', 'homeCategories', 'topSoldProducts'));
    }

    /**
     * Show the product detail page view
     */
    public function productDetail(Request $request) {
        $product = $this->getProductsService->getProductBySlug($request->slug, ['images', 'productVariants.color', 'category']);

        return view('product-detail', compact('product'));
    }

    /**
     * Show the search page view
     */
    public function search(Request $request) {
        return view('search');
    }
}
