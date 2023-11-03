@extends('layouts.auth')
@section('title', 'Đăng nhập')

@section('content')
    <div class="row">
        <div class="col col-md-6 col-12">
            <h1 class="title">Đăng nhập</h1>
            <p class="my-3">
                Đăng nhập để không bỏ lỡ quyền lợi tích luỹ và hoàn tiền
                cho bất kỳ đơn hàng nào.
            </p>

            @include('includes.errors')

            <form id="external-login-form">
                @csrf

                <div class="fw-bold mb-3">
                    Đăng nhập hoặc đăng ký (miễn phí)
                </div>
                <div class="d-flex">
                    <button type="button" class="btn border-1 border-black social-btn">
                        <img src="{{ asset("images/Google__G__Logo.svg.png") }}" alt="google"
                            class="w-100 h-100 object-fit-contain" />
                    </button>
                </div>
            </form>

            <div class="divider d-flex align-items-center justify-content-center my-4">
                <p class="text-center fw-bold mx-3 mb-0 text-muted bg-white px-2">
                    OR
                </p>
            </div>

            <form method="POST" id="login-form" class="mb-3" action="{{ route("login") }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email của bạn</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old("email") }}" aria-describedby="emailHelp" />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" />
                    <label class="form-check-label" for="remember">Remember</label>
                </div>
                
                <button type="submit" class="btn btn-dark w-100 py-3">
                    Đăng nhập
                </button>

                <div class="error text-center mt-3 fs-6 fw-medium"></div>
            </form>

            <div class="d-flex justify-content-between align-items-center fw-bold flex-wrap">
                <a href="{{ route("register") }}">Đăng ký tài khoản mới</a>
                <a href="{{ route("password.request") }}">Quên mật khẩu</a>
            </div>
        </div>

        <div class="col col-md-6 d-md-block d-none">
            <img src="https://mcdn.coolmate.me/image/September2023/mceclip0_49.jpg" alt="image"
                class="w-100 h-100 object-fit-cover" />
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script>
        $().ready(function() {
            $("#login-form").validate({
                rules: {
                    "email": {
                        email: true,
                        required: true,
                    },
                    "password": {
                        required: true,
                    },
                },
                messages: {
                    "email": {
                        email: "Email không hợp lệ",
                        required: "Email không được để trống",
                    },
                    "password": {
                        required: "Mật khẩu không được để trống",
                    },
                }
            });
        });
    </script>
@endsection