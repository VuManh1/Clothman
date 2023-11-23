@component('mail::message')

# Đặt hàng thành công!

Hello, {{ $order->customer_name }}. Đơn hàng của bạn đã được xác nhận và sẽ được vận chuyển trong 2 ngày tới!


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