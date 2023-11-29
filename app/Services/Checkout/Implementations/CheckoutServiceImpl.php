<?php

namespace App\Services\Checkout\Implementations;

use App\DTOs\CheckoutDto;
use App\DTOs\Orders\CreateOrderDto;
use App\DTOs\Payment\CreatePaymentDto;
use App\Exceptions\Products\ProductOutOfStockException;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Services\Cart\Interfaces\CartService;
use App\Services\Checkout\Interfaces\CheckoutService;
use App\Services\Orders\Interfaces\OrdersService;
use App\Services\Payment\Interfaces\PaymentService;
use App\Utils\OrderStatus;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutServiceImpl implements CheckoutService {
    public function __construct(
        private CartService $cartService,
        private OrdersService $ordersService,
        private PaymentService $paymentService,
        private ProductVariantRepository $productVariantRepository,
        private ProductRepository $productRepository
    ) {
        
    }

    public function processCheckout(CheckoutDto $data) {
        $cartData = $this->cartService->getCartData();
        $this->validateCarts($cartData['items']);

        DB::beginTransaction();
        try {            
            $this->decreaseProductQuantity($cartData['items']);

            $createPaymentDto = new CreatePaymentDto();
            $createPaymentDto->amount = $cartData['total'];
            $createPaymentDto->currency = "vnd";
            $createPaymentDto->paymentMethod = $data->paymentMethod;
            $createPaymentDto->status = "success";
    
            $payment = $this->paymentService->createPayment($createPaymentDto);
    
            $createOrderDto = $this->makeOrderDto($cartData, $data, $payment->id);
            $order = $this->ordersService->createOrder($createOrderDto);

            // remove all cart after create order
            $this->cartService->removeAllCart(Auth::check() ? Auth::id() : null);
            
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        return $order;
    }

    private function validateCarts($carts) {
        foreach ($carts as $cart) {
            $variant = $this->productVariantRepository->findById($cart->product_variant_id);

            if (!$variant) throw new ModelNotFoundException();

            if ($variant->quantity < $cart->quantity) throw new ProductOutOfStockException(); 
        }
    }

    private function decreaseProductQuantity($carts) {
        foreach ($carts as $cart) {
            $this->productVariantRepository->decrement($cart->product_variant_id, ['quantity' => $cart->quantity]);
            $this->productRepository->decrement($cart->product_id, ['quantity' => $cart->quantity]);
        }
    }

    private function makeOrderDto(array $cartData, CheckoutDto $checkoutDto, string $paymentId): CreateOrderDto {
        $createOrderDto = new CreateOrderDto();
        $createOrderDto->userId = Auth::check() ? Auth::id() : null;
        $createOrderDto->paymentId = $paymentId;
        $createOrderDto->status = OrderStatus::PENDING;
        $createOrderDto->customerName = $checkoutDto->name;
        $createOrderDto->email = $checkoutDto->email;
        $createOrderDto->address = $checkoutDto->address;
        $createOrderDto->phoneNumber = $checkoutDto->phonenumber;
        $createOrderDto->note = $checkoutDto->note;

        $createOrderDto->orderItems = [];
        foreach ($cartData['items'] as $cart) {
            array_push($createOrderDto->orderItems, [
                'product_id' => $cart->product_id,
                'product_variant_id' => $cart->product_variant_id,
                'quantity' => $cart->quantity,
                'price' => $cart->getPrice(),
            ]);
        }

        return $createOrderDto;
    }
}