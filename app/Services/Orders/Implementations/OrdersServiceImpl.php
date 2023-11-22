<?php

namespace App\Services\Orders\Implementations;

use App\DTOs\Orders\CreateOrderDto;
use App\DTOs\Orders\OrderParamsDto;
use App\Events\OrderCreated;
use App\Exceptions\Orders\OrderCanNotCancelException;
use App\Exceptions\Orders\OrderNotFoundException;
use App\Models\Order;
use App\Repositories\Interfaces\OrderItemRepository;
use App\Repositories\Interfaces\OrderRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Services\Orders\Interfaces\OrdersService;
use App\Utils\OrderStatus;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrdersServiceImpl implements OrdersService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private OrderItemRepository $orderItemRepository,
        private ProductVariantRepository $productVariantRepository,
        private ProductRepository $productRepository,
    ) {}

    public function getOrdersByParams(OrderParamsDto $params): LengthAwarePaginator {
        if (!$params->sortColumn) {
            $params->sortColumn = 'created_at';
            $params->sortOrder = 'desc';
        }

        return $this->orderRepository->findByParams($params);
    }

    public function getOrdersForUser(string $userId, $page, $limit): LengthAwarePaginator {
        return $this->orderRepository->findByUserId($userId, $page, $limit, [
            'orderItems', 'orderItems.product', 'orderItems.productVariant'
        ]);
    }

    public function getOrderByCode(string $code): Order {
        $order = $this->orderRepository->findByCode($code, [
            'payment', 'user', 'orderItems', 'orderItems.product', 'orderItems.productVariant'
        ]);

        if (!$order) {
            throw new OrderNotFoundException();
        }

        return $order;
    }

    public function createOrder(CreateOrderDto $createOrderDto): Order {
        $total = $this->calculateOrderTotal($createOrderDto->orderItems);
        $code = $this->generateOrderCode();

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

    public function cancelOrder(string $code, string $cancelReson = null): bool {
        $order = $this->orderRepository->findByCode($code);

        if (!$order) {
            throw new OrderNotFoundException();
        }

        $userId = Auth::id();
        if ($order->user_id !== null && $order->user_id !== $userId) {
            abort(403);
        }

        if ($order->status !== OrderStatus::PENDING) {
            throw new OrderCanNotCancelException("Không thể hủy đơn hàng này!");
        }

        $this->orderRepository->update($order->id, [
            'status' => OrderStatus::CANCELED,
            'cancel_reason' => $cancelReson
        ]);

        return true;
    }

    private function generateOrderCode(): string {
        $timestamp = now()->timestamp;
        $randomString = Str::random(4);

        $code = 'CTL-OD' . $timestamp . $randomString;

        return $code;
    }
}
