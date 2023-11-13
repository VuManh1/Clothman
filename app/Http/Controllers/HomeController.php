<?php

namespace App\Http\Controllers;

use App\Services\Products\Interfaces\GetProductsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $PRODUCTS_PER_SECTION = 8;

    public function __construct(
        private GetProductsService $getProductsService
    ) {
        
    }

    /**
     * Show the home page view
     */
    public function index() {
        $latestProducts = $this->getProductsService->getLatestProducts($this->PRODUCTS_PER_SECTION);
        
        return view('home', compact('latestProducts'));
    }
}
