<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Products\ProductParamsDto;
use App\Http\Controllers\Controller;
use App\Services\Products\Interfaces\GetProductsService;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{
    public function __construct(
        private GetProductsService $getProductsService
    ) {
        
    }

    /**
     * Get list of products
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProducts(Request $request) {
        $params = ProductParamsDto::fromRequest($request);
        $products = $this->getProductsService->getProductsByParams($params);

        return response()->json($products);
    }

    /**
     * Get top selling products
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopSelling(Request $request) {
        $products = $this->getProductsService->getTopSellingProducts(
            $request->query("count") ?? 10,
            $request->query("time") ?? 'week'
        );

        return response()->json($products);
    }
}
