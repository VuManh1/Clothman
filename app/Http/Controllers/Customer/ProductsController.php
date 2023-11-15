<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\DTOs\Products\SearchProductsDto;
use App\Services\Categories\Interfaces\GetCategoriesService;
use App\Services\Products\Interfaces\GetProductsService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct(
        private GetProductsService $getProductsService,
        private GetCategoriesService $getCategoriesService,
    ) {
        
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
        $params = SearchProductsDto::fromRequest($request);
        $products = $this->getProductsService->searchProducts($params);
        $categories = $this->getCategoriesService->getAllCategories();

        $keyword = $request->query('q');
        $selectedCategory = $request->query('category');
        $this->appendPaginatorURL($products);

        return view('search', compact('products', 'categories', 'keyword', 'selectedCategory'));
    }

    /**
     * Show the products page view
     */
    public function products(Request $request) {
        $products = $this->getProductsService->getProducts($request->page ?? 1, 25);
        $this->appendPaginatorURL($products);

        $title = "Tất cả sản phẩm";

        return view('products', compact('products', 'title'));
    }

    /**
     * Show the sale products page view
     */
    public function sales(Request $request) {
        $products = $this->getProductsService->getTopSaleProducts($request->page ?? 1, 25);
        $this->appendPaginatorURL($products);

        $title = "Các sản phẩm ưu đãi";

        return view('products', compact('products', 'title'));
    }
}
