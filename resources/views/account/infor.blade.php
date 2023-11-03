@extends('layouts.account')
@section('title', 'Tài khoản của bạn')

@section('account-content')
    <h1 class="title mb-3">Thông tin tài khoản</h1>

    <form>
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
    
@endsection