<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
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
    public function showCart(Request $request) {
        $user = Auth::user();
        $cart = $this->cartService->getCartData();

        return view('cart', compact('user', 'cart'));
    }
}
