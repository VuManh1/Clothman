<div class="account-order">
    <div class="account-order-header">
        <div>
            <a href="{{ route('account.orders.detail', [$order->code]) }}" class="account-order-code">
                #{{ $order->code }}
            </a>
            <div>{{ $order->getFormatedCreatedAt() }}</div>
        </div>
        <a href="{{ route('account.orders.detail', [$order->code]) }}" class="btn btn-dark">Xem chi tiết</a>
    </div>
    <div class="account-order-body">
        <div>Trạng thái: <span class="fw-bold">{{ $order->status }}</span></div>

        <div class="d-flex flex-column gap-3 my-3">

            @foreach ($order->orderItems as $item)
                <x-order-item :item="$item" />
            @endforeach

        </div>

        <div>Tổng cộng: <span class="fw-bold">{{ $order->getFormatedTotal() }}đ</span></div>
    </div>
</div>