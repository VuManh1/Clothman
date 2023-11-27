<?php

namespace App\Services\Orders\Implementations;

use App\DTOs\Orders\CreateOrderDto;
use App\DTOs\Orders\OrderParamsDto;
use App\DTOs\Orders\UpdateOrderDto;
use App\Events\OrderCompleted;
use App\Events\OrderCreated;
use App\Events\OrderShipped;
use App\Exceptions\Orders\OrderCanNotCancelException;
use App\Exceptions\Orders\OrderCanNotUpdateException;
use App\Exceptions\Orders\OrderNotFoundException;
use App\Models\Order;
use App\Repositories\Interfaces\OrderItemRepository;
use App\Repositories\Interfaces\OrderRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Services\Orders\Interfaces\OrdersService;
use App\Utils\OrderStatus;
use Illuminate\Pagination\LengthAwarePaginator;
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
            'orderItems.product', 'orderItems.productVariant', 'orderItems.productVariant.color'
        ]);
    }

    public function getOrderByCode(string $code): Order {
        $order = $this->orderRepository->findByCode($code, [
            'payment', 'orderItems.product', 'orderItems.productVariant', 'orderItems.productVariant.color'
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

    public function updateOrder(string $code, UpdateOrderDto $updateOrderDto): Order {
        $order = $this->orderRepository->findByCode($code);

        if (!$order) {
            throw new OrderNotFoundException();
        }

        if ($order->status === OrderStatus::CANCELED || $order->status === OrderStatus::COMPLETED) {
            throw new OrderCanNotUpdateException("Không thể cập nhập đơn hàng này!");
        }

        $updatedOrder = $this->orderRepository->update($order->id, [
            'status' => $updateOrderDto->status,
            'address' => $updateOrderDto->address
        ]);

        switch ($updatedOrder->status) {
            case OrderStatus::SHIPPING:
                event(new OrderShipped($updatedOrder));
                break;
            case OrderStatus::COMPLETED:
                event(new OrderCompleted($updatedOrder));
                break;
            default:
                break;
        }

        return $updatedOrder;
    }

    public function cancelOrder(string $code, string $cancelReson = null): bool {
        $order = $this->orderRepository->findByCode($code);

        if (!$order) {
            throw new OrderNotFoundException();
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
