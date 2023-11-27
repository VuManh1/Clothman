@extends('layouts.app')
@section('title', 'Trang chủ - Clothman')

@section('content')
    <!-- Banner start -->
    <section>
        <div id="banner" class="carousel slide banner">
            <div class="carousel-indicators">
                @foreach ($banners as $banner)
                    <button type="button" data-bs-target="#banner" data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : '' }}"
                        aria-label="Slide {{ $loop->index + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                    @if ($banner->link)
                        <a href="{{ $banner->link }}" class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset($banner->image_url) }}" class="d-block w-100" alt="{{ $banner->name }}">
                        </a>                        
                    @else
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset($banner->image_url) }}" class="d-block w-100" alt="{{ $banner->name }}">
                        </div>
                    @endif
                @endforeach
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

        <x-products-carousel id="newProductsCarousel" :products="$latestProducts" />
    </section>
    <!-- New products section end -->

    <!-- Top sold products section start -->
    <section class="container my-5">
        <h3 class="title mb-3">
            Bán chạy nhất tuần
        </h3>

        <x-products-carousel id="topSellingProductsCarousel" :products="$topSellingProducts->pluck('product')" />
    </section>
    <!-- Top sold products section end -->

    <!-- Home Categories section start -->
    @foreach ($homeCategories as $homeCategory)
        <section>
            <img src="{{ asset($homeCategory->banner_url) }}" alt="{{ $homeCategory->name }}" class="d-block w-100">

            <div class="container my-5">
                <h3 class="title mb-3">
                    Sản phẩm {{ $homeCategory->name}}
                </h3>

                <x-products-carousel id="categoryCarousel{{ $loop->index + 1 }}" :products="$homeCategory->products" />
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
        new MultiItemCarousel("#topSellingProductsCarousel", { interval: 4000 });
        new MultiItemCarousel("#categoryCarousel1", { interval: 4000 });
        new MultiItemCarousel("#categoryCarousel2", { interval: 4000 });
    </script>
@endsection