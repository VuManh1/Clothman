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
                    <div class="cart-item">
                        <img src="https://media.coolmate.me/cdn-cgi/image/width=320,height=362,quality=80/image/September2023/graphic.spec.2_4.jpg"
                            alt="...">

                        <div class="cart-item-info">
                            <a href="#" class="cart-item-title">T-Shirt chạy bộ Special</a>
                            <div>Đen / 2XL</div>

                            <div class="cart-item-actions">
                                <div class="quantity-box">
                                    <div class="quantity-decrease"><span>-</span></div>
                                    <input type="number" name="quantity" min="1" max="50" value="1"
                                        readonly />
                                    <div class="quantity-increase"><span>+</span></div>
                                </div>

                                <div class="fw-bold">199.000đ</div>
                            </div>
                        </div>

                        <div class="cart-item-delete">
                            <span>&#10005;</span>
                        </div>
                    </div>
                </div>
                <!-- Cart items end -->

                <hr>

                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Tạm tính</div>
                        <div class="fw-bold">199.000đ</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Phí giao hàng</div>
                        <div class="fw-bold">+25.000đ</div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <div>Tổng</div>
                    <div class="fw-bold fs-5">224.000đ</div>
                </div>
            </section>
            <!-- card section end -->

            <div class="col col-12 col-md-7">
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
                                    value="{{ $user ? $user->name : '' }}" placeholder="Họ tên" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber"
                                    value="{{ $user ? $user->phone_number : '' }}" placeholder="Số điện thoại" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user ? $user->email : '' }}" placeholder="Email" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $user ? $user->address : '' }}"
                                placeholder="Địa chỉ (ví dụ: 74 Nguyễn Lân, phường Phương Liệt, quận Thanh Xuân, Hà Nội)" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="note" name="note"
                                placeholder="Ghi chú thêm (ví dụ: Giao hàng giờ hành chính)" />
                        </div>
                    </div>
                </section>
                <!-- Shipping information section end -->

                <!-- payment method section start -->
                <section class="mb-5">
                    <div class="title mb-3">Hình thức thanh toán</div>

                    <div class="d-flex flex-column gap-3">
                        <div class="payment-method-item active" data-method="COD">
                            <div class="payment-method-checkbox">
                                <div class="payment-method-checkmark"></div>
                            </div>
                            <div>
                                <img src="{{ asset('fonts/PaymentCOD.svg') }}" alt="COD">
                            </div>
                            <div class="payment-method-title">COD thanh toán khi nhận hàng</div>
                        </div>
                        <div class="payment-method-item" data-method="paypal">
                            <div class="payment-method-checkbox">
                                <div class="payment-method-checkmark"></div>
                            </div>
                            <div style="width: 50px;">
                                <img src="{{ asset('fonts/paypal-seeklogo.com.svg') }}" alt="paypal" class="d-block">
                            </div>
                            <div class="payment-method-title">Thanh toán Paypal</div>
                        </div>
                    </div>
                </section>
                <!-- payment method section end -->

                <button class="btn btn-dark w-100 py-3">Thanh toán</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/QuantityBox.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection
