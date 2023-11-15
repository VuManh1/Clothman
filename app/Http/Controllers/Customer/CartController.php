<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct() {
        
    }

    /**
     * Show the cart page view
     */
    public function cart(Request $request) {
        $user = Auth::user();

        return view('cart', compact('user'));
    }
}
