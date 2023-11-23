@extends('layouts.auth')
@section('title', 'Đăng ký')

@section('content')
    <div class="row">
        <div class="col col-md-6 col-12">
            <h1 class="title">Đăng ký</h1>
            <p class="my-3">
                Đăng nhập để không bỏ lỡ quyền lợi tích luỹ và hoàn tiền
                cho bất kỳ đơn hàng nào.
            </p>

            @include('includes.errors')

            <div class="fw-bold mb-3">
                Đăng nhập hoặc đăng ký (miễn phí)
            </div>
            <div class="d-flex">
                <a href="{{ route('auth.google') }}" class="btn border-1 border-black social-btn">
                    <img src="{{ asset("images/Google__G__Logo.svg.png") }}" alt="google"
                        class="w-100 h-100 object-fit-contain" />
                </a>
            </div>

            <div class="divider d-flex align-items-center justify-content-center my-4">
                <p class="text-center fw-bold mx-3 mb-0 text-muted bg-white px-2">
                    OR
                </p>
            </div>

            <form method="POST" id="login-form" class="mb-3" action="{{ route("register") }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Tên của bạn</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old("name") }}" />
                </div>
                <div class="mb-3">
                    <label for="phonenumber" class="form-label">SĐT của bạn</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber"  value="{{ old("phonenumber") }}"/>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email của bạn</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old("email") }}" aria-describedby="emailHelp" />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="mb-3">
                    <label for="re-password" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="re-password" name="re-password" />
                </div>
                
                <button type="submit" class="btn btn-dark w-100 py-3">
                    Đăng ký
                </button>

                <div class="error text-center mt-3 fs-6 fw-medium"></div>
            </form>

            <div class="d-flex justify-content-between align-items-center fw-bold flex-wrap">
                <a href="{{ route("login") }}">Đăng nhập</a>
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
            jQuery.validator.addMethod("phonenumber", function (value, element) {
                return /^\d{3}-?\d{3}-?\d{4}$/g.test(value);
            }, "SĐT không hợp lệ");

            $("#login-form").validate({
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
                    "password": {
                        required: true,
                        minlength: 8
                    },
                    "re-password": {
                        equalTo: "#password",
                    }
                },
                messages: {
                    "name": {
                        required: "Tên không được để trống",
                    },
                    "phonenumber": {
                        required: "SĐT không được để trống",

                    },
                    "email": {
                        email: "Email không hợp lệ",
                        required: "Email không được để trống",
                    },
                    "password": {
                        required: "Mật khẩu không được để trống",
                        minlength: "Mật khẩu không được ít hơn 8 ký tự"
                    },
                    "re-password": {
                        equalTo: "Mật khẩu không khớp",
                    }
                }
            });
        });
    </script>
@endsection