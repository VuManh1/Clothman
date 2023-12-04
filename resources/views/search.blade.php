@extends('layouts.app')
@section('title', 'Tìm kiếm - '.$keyword)

@section('content')
    <div class="container my-5">
        <h4 class="title mb-2">Sản phẩm</h4>
        <form class="d-flex flex-wrap gap-3" id="search-form">
            <div style="width: 300px;">
                <input type="text" name="q" value="{{ $keyword }}"
                    class="border-1 border-black rounded-pill py-2 px-3 bg-white d-block w-100"
                    placeholder="Tìm kiếm sản phẩm...">
            </div>
            <select class="form-select w-auto rounded-pill border-black" name="category">
                <option value="" selected>Tất cả</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" @selected($category->slug === $selectedCategory)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <input type="submit" value="Search" class="btn btn-dark rounded d-block d-sm-none">
        </form>

        <hr>

        <h4 class="title">Kết quả tìm kiếm: {{ $keyword }}</h4>

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

@section('scripts')
    <script>
        $(function () {
            $('#search-form select').on('change', function () {
                $('#search-form').submit();
            });
        });
    </script>
@endsection