<?php

namespace App\Http\Controllers\Customer;

use App\DTOs\Cart\AddToCartDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Services\Cart\Interfaces\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(
        private CartService $cartService
    ) {
    }

    /**
     * Show the cart page view
     */
    public function cart(Request $request) {
        $user = Auth::user();
        $carts = $this->cartService->getCarts();

        return view('cart', compact('user', 'carts'));
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
        ], 200);
    }
}
