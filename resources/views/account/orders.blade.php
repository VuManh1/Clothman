@extends('layouts.account')
@section('title', 'Đơn hàng của bạn')

@section('account-content')
    <h1 class="title mb-3">Lịch sử đơn hàng</h1>
    <div class="mb-3 fs-5 text-secondary">Đơn hàng của bạn</div>
    
    <div class="d-flex flex-column gap-3">      
        @forelse ($orders as $order)
            <x-order :order="$order" />
        @empty
            <div class="w-auto mx-auto fw-bold">Bạn chưa có đơn hàng nào...</div>
        @endforelse  
    </div>
@endsection