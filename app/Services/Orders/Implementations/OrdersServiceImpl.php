<?php

namespace App\Services\Orders\Implementations;

use App\DTOs\Orders\CreateOrderDto;
use App\Events\OrderCreated;
use App\Exceptions\Orders\OrderNotFoundException;
use App\Models\Order;
use App\Repositories\Interfaces\OrderItemRepository;
use App\Repositories\Interfaces\OrderRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Services\Orders\Interfaces\OrdersService;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrdersServiceImpl implements OrdersService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private OrderItemRepository $orderItemRepository,
        private ProductVariantRepository $productVariantRepository,
        private ProductRepository $productRepository,
    ) {}

    public function getOrdersForUser(string $userId, $page, $limit): LengthAwarePaginator {
        return $this->orderRepository->findByUserId($userId, $page, $limit, [
            'orderItems', 'orderItems.product', 'orderItems.productVariantt'
        ]);
    }

    public function getOrderByCode(string $code): Order {
        $order = $this->orderRepository->findByCode($code, [
            'payment', 'user', 'orderItems', 'orderItems.product', 'orderItems.productVariantt'
        ]);

        if (!$order) {
            throw new OrderNotFoundException();
        }

        return $order;
    }

    public function createOrder(CreateOrderDto $createOrderDto): Order {
        $total = $this->calculateOrderTotal($createOrderDto->orderItems);
        $code = $this->generateOrderCode();

        DB::beginTransaction();

        try {
            $order = $this->orderRepository->create([
                'user_id' => $createOrderDto->userId,
                'payment_id' => $createOrderDto->paymentId,
                'status' => $createOrderDto->status,
                'customer_name' => $createOrderDto->customerName,
                'email' => $createOrderDto->email,
                'phone_number' => $createOrderDto->phoneNumber,
                'address' => $createOrderDto->address,
                'note' => $createOrderDto->note,
                'code' => $code,
                'total' => $total
            ]);
            
            foreach ($createOrderDto->orderItems as $item) {
                $this->orderItemRepository->create([
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['product_variant_id'],
                    'order_id' => $order->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Decrement quantity of product and variant
                $this->productVariantRepository->decrement($item['product_variant_id'], ['quantity' => $item['quantity']]);
                $this->productRepository->decrement($item['product_id'], ['quantity' => $item['quantity']]);
                
                $this->productRepository->increment($item['product_id'], ['sold' => $item['quantity']]);
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        event(new OrderCreated($order));

        return $order;
    }

    private function calculateOrderTotal(array $items): int {
        $total = 0;

        foreach ($items as $item) {
            $total += $item['price'];
        }

        return $total;
    }

    private function generateOrderCode(): string {
        $timestamp = now()->timestamp;
        $randomString = Str::random(4);

        $code = 'CTL-OD' . $timestamp . $randomString;

        return $code;
    }
}
