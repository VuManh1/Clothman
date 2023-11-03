@extends('layouts.account')
@section('title', 'Tài khoản của bạn')

@section('account-content')
    <h1 class="title mb-3">Thông tin tài khoản</h1>

    <form action="{{ route("account.infor") }}" id="update-account-form">
        @method('PUT')
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" disabled value="{{ Auth::user()->email }}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
        </div>
        <div class="mb-3">
            <label for="phonenumber" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{ Auth::user()->phone_number }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
        </div>
        
        <button type="submit" class="btn btn-dark rounded-pill w-100">Cập nhật</button>
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script>
        $().ready(function() {
            jQuery.validator.addMethod("phonenumber", function (value, element) {
                return /^\d{3}-?\d{3}-?\d{4}$/g.test(value);
            }, "SĐT không hợp lệ");

            $("#update-account-form").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "phonenumber": {
                        required: true,
                        phonenumber: true
                    },
                },
                messages: {
                    "name": {
                        required: "Tên không được để trống",
                    },
                    "phonenumber": {
                        required: "SĐT không được để trống",
                    },
                }
            });

            $("#update-account-form").on("submit", function (e) {
                e.preventDefault();

                if ($(this).valid()) {
                    $.ajax({
                        url: "{{ route('account.update') }}", 
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: $("#name").val(),
                            phonenumber: $("#phonenumber").val(),
                            address: $("#address").val(),
                        },
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        xhrFields: {
                            withCredentials: true
                        },
                        type: "PUT",
                        success(result) {
                            toastr.success("Tài khoản của bạn đã được cập nhập");
                        },
                        error(xhr,status,error) {
                            toastr.error("Có lỗi xảy ra, vui lòng thử lại");
                        }
                    });
                }
            })
        });
    </script>
@endsection