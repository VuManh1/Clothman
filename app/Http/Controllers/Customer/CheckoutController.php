<?php

namespace App\Http\Controllers\Customer;

use App\DTOs\CheckoutDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Services\Checkout\Interfaces\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        private CheckoutService $checkoutService
    ) {
        
    }

    /**
     * Handle checkout form submission
     */
    public function checkout(CheckoutRequest $request) {
        $request->validated();

        $data = CheckoutDto::fromRequest($request);
        $result = $this->checkoutService->processCheckout($data);

        return redirect()->route('checkout.success')->with('success', 'Thanh toán và đặt hàng thành công!');
    }

    /**
     * Show checkout success view
     */
    public function success(Request $request) {
        return view('checkout.success');
    }
}
