@extends('layouts.account')
@section('title', 'Đơn hàng #' . $order->code)

@section('account-content')
    <div class="modal fade" tabindex="-1" id="cancel-order-modal">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('account.orders.cancel', [$order->code]) }}" method="POST">
                @method('PATCH')
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Hủy đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label text-black fw-medium">Lí do hủy đơn của bạn là gì?</label>

                        <div class="d-flex flex-column gap-2 my-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cancel_reason" id="cancel_reason1" value="Tôi muốn đổi phương thức thanh toán">
                                <label class="form-check-label" for="cancel_reason1">
                                    Tôi muốn đổi phương thức thanh toán
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cancel_reason" id="cancel_reason2" value="Tôi không muốn mua đơn hàng này nữa">
                                <label class="form-check-label" for="cancel_reason2">
                                    Tôi không muốn mua đơn hàng này nữa
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cancel_reason" id="cancel_reason3" value="Hết tiền rùi :<">
                                <label class="form-check-label" for="cancel_reason3">
                                    Hết tiền rùi :<
                                </label>
                            </div>
                        </div>

                        <input type="text" placeholder="Lí do khác..." name="cancel_reason_other" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Xác nhận</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>

    <h1 class="title mb-4">
        Thông tin đơn hàng #{{ $order->code }}
        <span class="text-secondary">({{ $order->status }})</span>
    </h1>

    <div class="mb-4">
        @if ($order->status === 'PENDING' && $order->payment->status === 'UNPAID')
            <button class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#cancel-order-modal">
                Hủy đơn hàng
            </button>
        @endif
    </div>

    <div class="d-flex flex-column gap-3 mb-4">
        <div class="row">
            <div class="col col-4 fw-bolder">Ngày đặt hàng: </div>
            <div class="col col-8">{{ $order->getFormatedCreatedAt() }}</div>
        </div>
        <div class="row">
            <div class="col col-4 fw-bolder">Tên người nhận: </div>
            <div class="col col-8">{{ $order->customer_name }}</div>
        </div>
        <div class="row">
            <div class="col col-4 fw-bolder">Email: </div>
            <div class="col col-8">{{ $order->email }}</div>
        </div>
        <div class="row">
            <div class="col col-4 fw-bolder">Số điện thoại: </div>
            <div class="col col-8">{{ $order->phone_number }}</div>
        </div>
        <div class="row">
            <div class="col col-4 fw-bolder">Phương thức thanh toán: </div>
            <div class="col col-8">{{ $order->payment->payment_method }}</div>
        </div>
        <div class="row">
            <div class="col col-4 fw-bolder">Địa chỉ giao hàng: </div>
            <div class="col col-8">{{ $order->address }}</div>
        </div>
        <div class="row">
            <div class="col col-4 fw-bolder">Ghi chú: </div>
            <div class="col col-8">{{ $order->note ?? 'NULL' }}</div>
        </div>
    </div>

    <h4 class="title">Các sản phẩm: </h4>
    <div class="d-flex flex-column gap-3 my-3">
        @foreach ($order->orderItems as $item)
            <x-order-item :item="$item" />
        @endforeach
    </div>

    <div>Tổng cộng: <span class="fw-bold">{{ $order->getFormatedTotal() }}đ</span></div>
@endsection
