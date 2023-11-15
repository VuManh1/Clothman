@extends('layouts.app')
@section('title', $title)

@section('content')
    <div class="container my-5">
        <h1 class="title">{{ $title }}</h1>

        <!-- Products section start -->
        <section class="row row-cols-2 row-cols-md-4 row-cols-lg-5 gy-4 my-3">
            @foreach ($products as $product)
                <div>
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </section>
        @if (!$products->isNotEmpty())
            <div class="text-dark fs-5">Không tìm thấy sản phẩm nào.</div>
        @endif

        {{ $products->links() }}
        <!-- Products section end -->
    </div>
@endsection