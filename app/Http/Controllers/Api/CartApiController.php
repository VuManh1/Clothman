<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Cart\AddToCartDto;
use App\DTOs\Cart\RemoveCartDto;
use App\DTOs\Cart\UpdateCartDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\RemoveCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
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

    /**
     * Handle update cart submission
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCart(UpdateCartRequest $request) {
        $request->validated();
        $data = UpdateCartDto::fromRequest($request);

        $cartData = $this->cartService->updateCart($data);

        return response()->json([
            'success' => true,
            'data' => $cartData
        ], 200);
    }

    /**
     * Handle remove cart submission
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCart(RemoveCartRequest $request) {
        $request->validated();
        $data = RemoveCartDto::fromRequest($request);

        $cartData = $this->cartService->removeCart($data);

        return response()->json([
            'success' => true,
            'data' => $cartData
        ], 200);
    }
}
