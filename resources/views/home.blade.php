@extends('layouts.app')
@section('title', 'Trang chủ - Clothman')

@section('content')
    <!-- Banner start -->
    <section>
        <div id="banner" class="carousel slide banner">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#banner" data-bs-slide-to="0"
                    class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#banner" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://media.coolmate.me/cdn-cgi/image/width=1920,quality=90,format=auto/uploads/October2023/ssdBanner-50-thudong2_(1).jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://media.coolmate.me/cdn-cgi/image/width=1920,quality=90,format=auto/uploads/October2023/ssFALL_WINTER.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#banner"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#banner"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- Banner end -->

    <!-- New products section start -->
    <section class="container my-5">
        <h3 class="title mb-3">
            Sản phẩm mới
        </h3>

        <div id="newProductsCarousel" class="carousel multi-item-carousel">
            <div class="carousel-inner">
                @foreach ($latestProducts as $product)
                    <div class="carousel-item">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#newProductsCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#newProductsCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- New products section end -->

    <!-- Top sold products section start -->
    <section class="container my-5">
        <h3 class="title mb-3">
            Bán chạy nhất
        </h3>

        <div id="topSoldProductsCarousel" class="carousel multi-item-carousel">
            <div class="carousel-inner">
                @foreach ($topSoldProducts as $product)
                    <div class="carousel-item">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#topSoldProductsCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#topSoldProductsCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- Top sold products section end -->

    <!-- Home Categories section start -->
    @foreach ($homeCategories as $homeCategory)
        <section>
            <img src="{{ asset($homeCategory->banner_url) }}" alt="..." class="d-block w-100">

            <div class="container my-5">
                <h3 class="title mb-3">
                    Sản phẩm {{ $homeCategory->name}}
                </h3>

                <div id="categoryOneCarousel" class="carousel multi-item-carousel">
                    <div class="carousel-inner">
                        @foreach ($homeCategory->products as $product)
                            <div class="carousel-item">
                                <x-product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#categoryOneCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#categoryOneCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
    @endforeach
    <!-- Home Categories section end -->
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.mobile.custom.min.js') }}"></script>
    <script src="{{ asset('js/MultiItemCarousel.js') }}"></script>

    <script>
        new MultiItemCarousel("#newProductsCarousel", { interval: 4000 });
        new MultiItemCarousel("#topSoldProductsCarousel", { interval: 4000 });
        new MultiItemCarousel("#categoryOneCarousel", { interval: 4000 });
        new MultiItemCarousel("#categoryTwoCarousel", { interval: 4000 });
    </script>
@endsection