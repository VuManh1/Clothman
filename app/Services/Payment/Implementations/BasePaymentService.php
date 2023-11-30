<?php

namespace App\Services\Payment\Implementations;

use App\DTOs\CheckoutDto;
use App\DTOs\Orders\CreateOrderDto;
use App\Exceptions\Products\ProductOutOfStockException;
use App\Models\Order;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Services\Cart\Interfaces\CartService;
use App\Services\Orders\Interfaces\OrdersService;
use App\Services\Payment\Interfaces\PaymentService;
use App\Utils\OrderStatus;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

abstract class BasePaymentService implements PaymentService {
    protected $cartData;
    protected ?CheckoutDto $checkoutDto = null;

    public function __construct(
        protected CartService $cartService,
        protected OrdersService $ordersService,
        protected ProductRepository $productRepository,
        protected ProductVariantRepository $productVariantRepository
    ) {
        $this->cartData = $this->cartService->getCartData();
    }

    protected function validateCart() {
        foreach ($this->cartData['items'] as $cart) {
            $variant = $this->productVariantRepository->findById($cart->product_variant_id);

            if (!$variant) throw new ModelNotFoundException();

            if ($variant->quantity < $cart->quantity) 
                throw new ProductOutOfStockException("Sản phẩm ".$cart->product->name." đã hết hàng. Vui lòng giảm số lượng hoặc xóa khỏi giỏ hàng."); 
        }
    }

    protected function decreaseProductQuantity() {
        foreach ($this->cartData['items'] as $cart) {
            $this->productVariantRepository->decrement($cart->product_variant_id, ['quantity' => $cart->quantity]);
            $this->productRepository->decrement($cart->product_id, ['quantity' => $cart->quantity]);
        }
    }

    protected function makeOrder(string $paymentId): Order {
        if (!$this->checkoutDto) throw new Exception("CheckoutDto must set!");

        $createOrderDto = new CreateOrderDto();
        $createOrderDto->userId = Auth::check() ? Auth::id() : null;
        $createOrderDto->paymentId = $paymentId;
        $createOrderDto->status = OrderStatus::PENDING;
        $createOrderDto->customerName = $this->checkoutDto->name;
        $createOrderDto->email = $this->checkoutDto->email;
        $createOrderDto->address = $this->checkoutDto->address;
        $createOrderDto->phoneNumber = $this->checkoutDto->phonenumber;
        $createOrderDto->note = $this->checkoutDto->note;

        $createOrderDto->orderItems = [];
        foreach ($this->cartData['items'] as $cart) {
            array_push($createOrderDto->orderItems, [
                'product_id' => $cart->product_id,
                'product_variant_id' => $cart->product_variant_id,
                'quantity' => $cart->quantity,
                'price' => $cart->getPrice(),
            ]);
        }

        return $this->ordersService->createOrder($createOrderDto);
    }
}