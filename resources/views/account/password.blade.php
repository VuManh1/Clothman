@extends('layouts.account')
@section('title', 'Mật khẩu')

@section('account-content')
    <h1 class="title mb-3">Mật khẩu</h1>

    <form id="update-password-form" >
        <div class="mb-3">
            <label for="old_password" class="form-label">Mật khẩu cũ</label>
            <input type="password" class="form-control" id="old_password" name="old_password" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control" id="password" name="password" />
        </div>
        <div class="mb-3">
            <label for="re_password" class="form-label">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" id="re_password" name="re_password" />
        </div>
        
        <button id="submit-btn" type="submit" class="btn btn-dark rounded-pill w-100 loadable-btn">
            <div class="loadable-content">
                Đổi mật khẩu
            </div>
            <div class="spinner spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script>
        $().ready(function() {
            $("#update-password-form").validate({
                rules: {
                    "old_password": {
                        required: true,
                        minlength: 8
                    },
                    "password": {
                        required: true,
                        minlength: 8
                    },
                    "re_password": {
                        equalTo: "#password",
                    }
                },
                messages: {
                    "old_password": {
                        required: "Mật khẩu cũ không được để trống",
                        minlength: "Mật khẩu cũ không được ít hơn 8 ký tự"
                    },
                    "password": {
                        required: "Mật khẩu mới không được để trống",
                        minlength: "Mật khẩu mới không được ít hơn 8 ký tự"
                    },
                    "re_password": {
                        equalTo: "Mật khẩu không khớp",
                    }
                }
            });

            $("#update-password-form").on("submit", function (e) {
                e.preventDefault();

                if ($(this).valid()) {
                    $("#submit-btn").addClass("loading");
                    $("#submit-btn").attr("disabled", true);

                    $.ajax({
                        url: "{{ route('api.me.password.update') }}", 
                        data: {
                            _token: '{{ csrf_token() }}',
                            old_password: $("#old_password").val(),
                            password: $("#password").val(),
                        },
                        type: "PATCH",
                        success (result) {
                            toastr.success(result.message);
                           
                            $("#submit-btn").removeClass("loading");
                            $("#submit-btn").attr("disabled", false);
                            resetForm();
                        },
                        error (xhr, status, error) {
                            toastr.error(xhr.responseJSON.message);
                            $("#submit-btn").removeClass("loading");
                            $("#submit-btn").attr("disabled", false);
                        }
                    });
                }
            })
        });

        function resetForm() {
            $("#old_password").val("");
            $("#password").val("");
            $("#re_password").val("");
        }
    </script>
@endsection