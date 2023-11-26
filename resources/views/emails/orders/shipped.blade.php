@component('mail::message')

# Đơn hàng của bạn đang được vận chuyển

Hello, {{ $order->customer_name }}. Đơn hàng của bạn đang được vận chuyển và dự kiến sẽ đến bên bạn trong 2 ngày tới!

Cảm ơn quý khách vì đã mua hàng của chúng tôi!,
Clothman

@endcomponent