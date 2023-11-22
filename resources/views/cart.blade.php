@extends('layouts.app')
@section('title', 'Giỏ hàng')

@section('content')
    <div class="container my-5">
        <div class="row ">
            <!-- card section start -->
            <section class="col col-12 col-md-5 mb-5 border-end">
                <div class="title mb-3">Giỏ hàng</div>

                <!-- Cart items start -->
                <div class="d-flex flex-column gap-3">
                    @forelse ($cart['items'] as $item)
                        <x-cart-item :cart="$item" />
                    @empty
                        <div class="text-dark">Bạn không có sản phẩm nào trong giỏ hàng.</div>
                    @endforelse
                </div>
                <!-- Cart items end -->

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <div>Tổng</div>
                    <div class="fw-bold fs-5" id="total-price">{{ $cart['formated_total'] }}đ</div>
                </div>
            </section>
            <!-- card section end -->

            <form id="checkout-form" class="col col-12 col-md-7" method="POST" action="{{ route('checkout') }}">
                @csrf

                <!-- Shipping information section start -->
                <section class="mb-5">
                    @guest
                        <div class="fw-medium">
                            Bạn đã có tài khoản? hãy
                            <span><a href="{{ route('login') }}" class="fw-bold">Đăng nhập</a></span>
                        </div>
                    @endguest

                    <div>
                        <div class="title mb-3">Thông tin vận chuyển</div>

                        <div class="d-md-flex gap-3 mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user ? $user->name : old('name') }}" placeholder="Họ tên" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber"
                                    value="{{ $user ? $user->phone_number : old('phonenumber') }}" placeholder="Số điện thoại" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user ? $user->email : old('email') }}" placeholder="Email" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $user ? $user->address : old('address') }}"
                                placeholder="Địa chỉ (ví dụ: 74 Nguyễn Lân, phường Phương Liệt, quận Thanh Xuân, Hà Nội)" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="note" name="note" value="{{ old('note') }}"
                                placeholder="Ghi chú thêm (ví dụ: Giao hàng giờ hành chính)" />
                        </div>
                    </div>
                </section>
                <!-- Shipping information section end -->

                <!-- payment method section start -->
                <section class="mb-5">
                    <div class="title mb-3">Hình thức thanh toán</div>

                    <div class="d-flex flex-column gap-3">
                        <label class="payment-method-item active" for="COD">
                            <div class="payment-method-checkbox custom-radio">
                                <input type="radio" name="payment_method" id="COD" value="COD" checked>
                                <span class="checkmark"></span>
                            </div>
                            <div>
                                <img src="{{ asset('fonts/PaymentCOD.svg') }}" alt="COD">
                            </div>
                            <div class="payment-method-title">COD thanh toán khi nhận hàng</div>
                        </label>
                        {{-- <label class="payment-method-item" for="paypal">
                            <div class="payment-method-checkbox custom-radio">
                                <input type="radio" name="payment_method" id="paypal" value="paypal">
                                <span class="checkmark"></span>
                            </div>
                            <div style="width: 50px;">
                                <img src="{{ asset('fonts/paypal-seeklogo.com.svg') }}" alt="paypal" class="d-block">
                            </div>
                            <div class="payment-method-title">Thanh toán Paypal</div>
                        </label> --}}
                    </div>
                </section>
                <!-- payment method section end -->

                <button type="submit" id="checkout-btn" class="btn btn-dark w-100 py-3 loadable-btn")>
                    <div class="loadable-content">
                        Thanh toán
                    </div>
                    <div class="spinner spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('js/QuantityBox.js') }}"></script>
    <script>
        const csrf = '{{ csrf_token() }}';
        const updateCartUrl = '{{ route("api.cart.update") }}';
        const removeCartUrl = '{{ route("api.cart.destroy") }}';

        jQuery.validator.addMethod("phonenumber", function (value, element) {
                return /^\d{3}-?\d{3}-?\d{4}$/g.test(value);
        }, "Số điện thoại không hợp lệ");

        $().ready(function() {
            $("#checkout-form").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "phonenumber": {
                        required: true,
                        phonenumber: true
                    },
                    "email": {
                        email: true,
                        required: true,
                    },
                    "address": {
                        required: true,
                    },
                },
                messages: {
                    "name": {
                        required: "Vui lòng nhập tên của bạn",
                    },
                    "phonenumber": {
                        required: "Vui lòng nhập số điện thoại của bạn",
                    },
                    "email": {
                        email: "Email không hợp lệ",
                        required: "Vui lòng nhập địa chỉ email của bạn",
                    },
                    "address": {
                        required: "Vui lòng nhập địa chỉ của bạn",
                    },
                },
                submitHandler: function(form) {
                    if ($('.cart-item').length > 0) {
                        $('#checkout-btn').addClass('loading').attr('disabled', true);
    
                        form.submit();
                    } else {
                        toastr.error("Bạn không có sản phẩm nào trong giỏ hàng!");
                    }
                },
            });

            // disable form submitting when press Enter key
            $(window).keydown(function (e) {
                if(e.keyCode == 13) {
                    e.preventDefault();
                    return false;
                }
            });

            // event click on payment method items
            $(".payment-method-item").click(function () {
                $(".payment-method-item.active").removeClass("active");
                $(this).addClass("active");
            });
        });

    </script>
    <script src="{{ asset('js/update-cart.js') }}"></script>
    <script src="{{ asset('js/remove-cart.js') }}"></script>
@endsection
