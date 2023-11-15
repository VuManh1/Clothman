<!-- Header start -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Clothman" class="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.sales') }}">SALE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">SẢN PHẨM</a>
                    </li>
                    @foreach ($parentCategories as $parent)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route('category', [$parent->slug]) }}"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $parent->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($parent->childs as $child)
                                    <li><a class="dropdown-item" href="{{ route('category', [$child->slug]) }}">{{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
                <form role="search" action="{{ route('search') }}" method="GET">
                    <div class="position-relative w-100">
                        <div class="position-absolute top-50 start-0 w-auto fs-5"
                            style="transform: translate(70%, -50%);">
                            <i class="bi bi-search"></i>
                        </div>
                        <input type="text" name="q"
                            class="no-outline border-0 rounded-pill py-3 px-5 bg-white d-block w-100"
                            placeholder="Tìm kiếm sản phẩm...">
                    </div>
                </form>
                <div class="d-flex gap-2 ms-md-2 my-4 my-md-0">
                    @guest
                        <a href="{{ route('login') }}" class="mx-2">
                            <img src="https://www.coolmate.me/images/header/icon-account-white-new.svg" alt="account">
                        </a>
                    @else
                        <a href="{{ route('account.infor') }}" class="profile-box mx-3">
                            <img src="https://www.coolmate.me/images/header/icon-account-white-new.svg" alt="account">
                            <span class="profile-name">{{ Auth::user()->name }}</span>
                        </a>
                    @endguest

                    <div class="position-relative">
                        <a href="{{ route('cart') }}">
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
