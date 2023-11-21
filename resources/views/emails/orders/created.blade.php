<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        body {
            background-color: #ffe8d2;
            font-family: 'Montserrat', sans-serif
        }

        .card {
            border: none
        }

        .logo {
            background-color: #eeeeeea8
        }

        .totals tr td {
            font-size: 13px
        }

        .footer {
            background-color: #eeeeeea8
        }

        .footer span {
            font-size: 12px
        }

        .product-qty span {
            font-size: 12px;
            color: #dedbdb
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-left logo p-2 px-5"> <img src="https://i.imgur.com/2zDU056.png" width="50">
                    </div>
                    <div class="invoice p-5">
                        <h5>Đặt hàng thành công!</h5>
                        <span class="font-weight-bold d-block mt-4">Hello, {{ $order->customer_name }}</span>
                        <span>Đơn hàng của bạn đã được xác nhận và sẽ được vận chuyển trong 2 ngày tới!</span>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Ngày đặt hàng</span>
                                                <span>{{ $order->getFormatedCreatedAt() }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Mã đơn hàng</span>
                                                <span>#{{ $order->code }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Phương thức thanh toán</span>
                                                <span>{{ $order->payment->payment_method }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Địa chỉ</span>
                                                <span>{{ $order->address }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom">
                            <div class="d-flex flex-column gap-3 my-3">
                                @foreach ($order->orderItems as $item)
                                    <x-order-item :item="$item" />
                                @endforeach
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Tổng cộng</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>{{ $order->getFormatedTotal() }}đ</span> </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <p class="font-weight-bold mb-0">Cảm ơn quý khách vì đã mua hàng của chúng tôi!</p> 
                        <span>Clothman</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
