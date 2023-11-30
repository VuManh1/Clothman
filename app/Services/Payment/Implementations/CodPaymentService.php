<?php

namespace App\Services\Payment\Implementations;

use App\DTOs\CheckoutDto;
use App\Events\OrderCreated;
use App\Repositories\Interfaces\PaymentRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Services\Cart\Interfaces\CartService;
use App\Services\Orders\Interfaces\OrdersService;
use App\Utils\PaymentStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CodPaymentService extends BasePaymentService {
    public function __construct(
        protected CartService $cartService,
        protected OrdersService $ordersService,
        protected ProductRepository $productRepository,
        protected ProductVariantRepository $productVariantRepository,
        private PaymentRepository $paymentRepository
    ) {
        parent::__construct($cartService, $ordersService, $productRepository, $productVariantRepository);
    }

    public function processPayment(CheckoutDto $checkoutDto): array {
        $this->checkoutDto = $checkoutDto;
        $this->validateCart();

        DB::beginTransaction();
        try {
            $this->decreaseProductQuantity();

            $payment = $this->paymentRepository->create([
                'amount' => $this->cartData['total'],
                'payment_method' => 'COD',
                'currency' => 'vnd',
                'status' => PaymentStatus::UNPAID
            ]);
    
            $order = $this->makeOrder($payment->id);

            $this->cartService->removeAllCart(Auth::id());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        event(new OrderCreated($order));

        return [
            'success' => true,
            'order' => $order
        ];
    }
}