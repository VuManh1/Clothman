<!-- Header start -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Clothman" class="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold">
                    <li class="nav-item">
                        <a class="nav-link" href="#">SALE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">SẢN PHẨM</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Áo
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Áo thun</a></li>
                            <li><a class="dropdown-item" href="#">Áo sơ mi</a></li>
                            <li><a class="dropdown-item" href="#">Áo polo</a></li>
                            <li><a class="dropdown-item" href="#">Áo khoác</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Quần
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Quần shorts</a></li>
                            <li><a class="dropdown-item" href="#">Quần jeans</a></li>
                            <li><a class="dropdown-item" href="#">Quần dài</a></li>
                            <li><a class="dropdown-item" href="#">Quần thể thao</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Phụ kiện
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tất/Vớ</a></li>
                            <li><a class="dropdown-item" href="#">Nón/Mũ</a></li>
                        </ul>
                    </li>
                </ul>
                <form role="search">
                    <div class="position-relative w-100">
                        <div class="position-absolute top-50 start-0 w-auto fs-5"
                            style="transform: translate(70%, -50%);">
                            <i class="bi bi-search"></i>
                        </div>
                        <input type="text" class="no-outline border-0 rounded-pill py-3 px-5 bg-white d-block w-100"
                            placeholder="Tìm kiếm sản phẩm...">
                    </div>
                </form>
                <div class="d-flex gap-2 ms-md-2 my-4 my-md-0">
                    @guest
                        <a href="{{ route("login") }}">
                            <img src="https://www.coolmate.me/images/header/icon-account-white-new.svg" alt="account">
                        </a>
                    @else
                        <a href="{{ route("account.infor") }}">
                            <img src="https://www.coolmate.me/images/header/icon-account-white-new.svg" alt="account">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                    @endguest
                    
                    <div class="position-relative">
                        <a href="#">
                            <img src="https://www.coolmate.me/images/header/icon-cart-white-new.svg?v=1" alt="cart">
                        </a>
                        <div class="cart-quantity">5</div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Header end -->