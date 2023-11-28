<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Categories\Interfaces\GetCategoriesService;
use App\Services\Products\Interfaces\GetProductsService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct(
        private GetProductsService $getProductsService,
        private GetCategoriesService $getCategoriesService,
    ) {
        
    }

    public function getCategoryWithProducts(Request $request) {
        $category = $this->getCategoriesService->getCategoryBySlug($request->slug);
        $products = $this->getProductsService->getProductsByCategorySlug($request->slug, $request->page ?? 1, 25);
        $this->appendPaginatorURL($products);

        $title = "Sản phẩm - ".$category->name;

        return view('products', compact('products', 'title'));
    }
}
