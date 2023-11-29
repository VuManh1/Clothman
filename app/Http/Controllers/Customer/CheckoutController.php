<?php

namespace App\Http\Controllers\Customer;

use App\DTOs\CheckoutDto;
use App\Exceptions\Orders\OrderNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Services\Checkout\Interfaces\CheckoutService;
use App\Services\Orders\Interfaces\OrdersService;
use App\Services\Payment\Implementations\PaypalPaymentService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        private CheckoutService $checkoutService,
        private OrdersService $ordersService,
        private PaypalPaymentService $paypalPaymentService
    ) {
        
    }

    /**
     * Handle checkout form submission
     */
    public function checkout(CheckoutRequest $request) {
        $data = CheckoutDto::fromRequest($request);
        $result = $this->checkoutService->processCheckout($data);

        if (isset($result['redirect'])) {
            return redirect()->away($result['redirect']);
        }

        return redirect()->route('checkout.success', ['code' => $result['order']->code])
            ->with('success', 'Thanh toán và đặt hàng thành công!');
    }

    /**
     * Show checkout success view
     */
    public function success(Request $request) {
        $code = $request->query('code') ?? '';

        try {
            $order = $this->ordersService->getOrderByCode($code);
        } catch (OrderNotFoundException $ex) {
            return view('checkout.cancel');
        }

        return view('checkout.success', compact('order'));
    }

    /**
     * Show checkout cancel view
     */
    public function cancel() {
        return view('checkout.cancel');
    }

    public function paypalSuccess(Request $request) {
        $success = $this->paypalPaymentService->executePayment($request->query('token'));

        if (!$success) {
            return redirect()->route("checkout.cancel");
        }

        $result = $this->checkoutService->makeOrder('paypal');

        return redirect()->route('checkout.success', ['code' => $result['order']->code])
            ->with('success', 'Thanh toán và đặt hàng thành công!');        
    }
}
