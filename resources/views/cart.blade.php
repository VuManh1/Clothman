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

                {{-- <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Tạm tính</div>
                        <div class="fw-bold">{{ $cart['total'] }}đ</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Phí giao hàng</div>
                        <div class="fw-bold">+25.000đ</div>
                    </div>
                </div>

                <hr> --}}

                <div class="d-flex justify-content-between align-items-center">
                    <div>Tổng</div>
                    <div class="fw-bold fs-5">{{ number_format($cart['total']) }}đ</div>
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
