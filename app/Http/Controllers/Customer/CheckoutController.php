<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct() {
        
    }

    /**
     * Handle checkout form submission
     */
    public function checkout(CheckoutRequest $request) {
        $request->validated();

        return redirect()->back();
    }

    /**
     * Show checkout success view
     */
    public function success(Request $request) {
        return view('checkout.success');
    }
}
