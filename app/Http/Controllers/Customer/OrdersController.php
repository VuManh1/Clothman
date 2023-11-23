<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CancelOrderRequest;
use App\Services\Orders\Interfaces\OrdersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    private $ORDERS_PER_PAGE = 10;

    public function __construct(
        private OrdersService $ordersService
    ) {
        
    }

    /**
     * Display orders page
     */
    public function orders() {
        $userId = Auth::id() ?? "";
        $orders = $this->ordersService->getOrdersForUser($userId, 1, $this->ORDERS_PER_PAGE);

        return view("account.orders", [
            "page" => "orders",
            "orders" => $orders
        ]);
    }

    /**
     * Display order detail page
     */
    public function detail($code) {
        $order = $this->ordersService->getOrderByCode($code);

        return view("account.order-detail", [
            "page" => "",
            "order" => $order
        ]);
    }

    /**
     * Handle cancel order form submission
     */
    public function cancel(CancelOrderRequest $request, $code) {
        $this->ordersService->cancelOrder($code, $request->cancel_reason);

        return redirect()->back()->with('success', 'Hủy đơn hàng thành công');
    }
}
