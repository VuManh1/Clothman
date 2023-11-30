@component('mail::message')

# Đơn hàng đã được thanh toán!

Hello, {{ $order->customer_name }}. Đơn hàng #{{$order->code}} của bạn đã được thanh toán thành công!


@component('mail::table')
| Sản phẩm       | Số lượng         |  Giá   |
| :--------- | :------------- | :--------- |
@foreach ($order->orderItems as $item)
|   {{$item->product->name}}   |   {{$item->quantity}}   |   {{$item->getFormatedPrice()}}đ   |
@endforeach 
@endcomponent

**Tổng cộng:** {{ $order->getFormatedTotal() }}đ


Cảm ơn quý khách vì đã mua hàng của chúng tôi!,
Clothman

@endcomponent