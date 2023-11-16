<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Cart\AddToCartDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Services\Cart\Interfaces\CartService;

class CartApiController extends Controller
{
    public function __construct(
        private CartService $cartService
    ) {
    }

    public function count() {
        $count = $this->cartService->getCartCount();

        return response()->json([
            'count' => $count,
        ], 200);
    }

    /**
     * Handle add to cart submission
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(AddToCartRequest $request) {
        $request->validated();
        $data = AddToCartDto::fromRequest($request);

        $this->cartService->addToCart($data);

        return response()->json([
            'success' => true,
        ], 201);
    }
}
