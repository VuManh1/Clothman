<aside class="col col-12 col-md-3 d-flex flex-column gap-2">
    <a href="{{ route("account.infor") }}" class="account-sidebar-item {{ $page === "infor" ? "active" : "" }}">
        <div class="account-sidebar-item-icon">
            <i class="bi bi-person-circle"></i>
        </div>
        <div class="account-sidebar-item-title">Thông tin tài khoản</div>
        <div class="account-sidebar-item-arrow">
            <i class="bi bi-arrow-right"></i>
        </div>
    </a>
    <a href="{{ route("account.password") }}" class="account-sidebar-item {{ $page === "password" ? "active" : "" }}">
        <div class="account-sidebar-item-icon">
            <i class="bi bi-shield-lock-fill"></i>
        </div>
        <div class="account-sidebar-item-title">Mật khẩu</div>
        <div class="account-sidebar-item-arrow">
            <i class="bi bi-arrow-right"></i>
        </div>
    </a>
    <a href="{{ route('account.orders') }}" class="account-sidebar-item {{ $page === "orders" ? "active" : "" }}">
        <div class="account-sidebar-item-icon">
            <i class="bi bi-bag-check-fill"></i>
        </div>
        <div class="account-sidebar-item-title">Lịch sử đơn hàng</div>
        <div class="account-sidebar-item-arrow">
            <i class="bi bi-arrow-right"></i>
        </div>
    </a>
    <form action="{{ route("logout") }}" method="POST">
        @csrf
        
        <button type="submit" class="account-sidebar-item">
            <div class="account-sidebar-item-icon">
                <i class="bi bi-box-arrow-in-right"></i>
            </div>
            <div class="account-sidebar-item-title">Đăng xuất</div>
            <div class="account-sidebar-item-arrow">
                <i class="bi bi-arrow-right"></i>
            </div>
        </button>
    </form>
</aside>