@extends('layouts.account')
@section('title', 'Đơn hàng #'.$order->code)

@section('account-content')
    <h1 class="title mb-4">
        Thông tin đơn hàng #{{ $order->code }}
        <span class="text-secondary">({{ $order->status }})</span>
    </h1>

    <div class="mb-4">
        <button class="btn btn-danger">Hủy đơn hàng</button>
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
            <div class="col col-8">{{ $order->note ?? "NULL" }}</div>
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