<?php

namespace App\Services\Payment\Implementations;

use App\DTOs\CheckoutDto;
use App\Events\OrderCreated;
use App\Events\OrderPaid;
use App\Repositories\Interfaces\PaymentRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Services\Cart\Interfaces\CartService;
use App\Services\Orders\Interfaces\OrdersService;
use App\Utils\PaymentStatus;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentService extends BasePaymentService {
    public function __construct(
        protected CartService $cartService,
        protected OrdersService $ordersService,
        protected ProductRepository $productRepository,
        protected ProductVariantRepository $productVariantRepository,
        private PaymentRepository $paymentRepository,
    ) {
        parent::__construct($cartService, $ordersService, $productRepository, $productVariantRepository);
    }

    public function createPaypalPaymentUrl(int|float $amount): string {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('checkout.paypal.success'),
                "cancel_url" => route('checkout.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return $links['href'];
                }
            }

            throw new Exception();
        } else {
            throw new Exception();
        }
    }

    public function processPayment(CheckoutDto $checkoutDto): array {
        $this->checkoutDto = $checkoutDto;
        $this->validateCart();

        // convert vnd to usd
        $usdAmount = ceil($this->cartData['total'] * 0.000041);

        DB::beginTransaction();
        try {
            $this->decreaseProductQuantity();

            $payment = $this->paymentRepository->create([
                'amount' => $usdAmount,
                'payment_method' => 'paypal',
                'currency' => 'usd',
                'status' => PaymentStatus::UNPAID
            ]);
    
            $order = $this->makeOrder($payment->id);

            $paypalUrl = $this->createPaypalPaymentUrl($usdAmount);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        event(new OrderCreated($order));

        // save payment's ID to session to use later
        session(['payment_id' => $payment->id]);
        session(['order_code' => $order->code]);

        return [
            'success' => true,
            'redirect' => $paypalUrl,
        ];
    }

    public function confirmPaypalPayment(string $token): bool {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $paymentId = session('payment_id', '');
            session()->forget('payment_id');

            $this->paymentRepository->update($paymentId, [
                'status' => PaymentStatus::COMPLETED,
                'transaction_id' => $response['id'],
                'payer_id' => $response['payer']['payer_id']
            ]);

            $orderCode = session('order_code', '');
            $order = $this->ordersService->getOrderByCode($orderCode);
            event(new OrderPaid($order));

            $this->cartService->removeAllCart(Auth::id());

            return true;
        } else {
            return false;
        }
    }
}