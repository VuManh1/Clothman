@extends('layouts.app')
@section('title', $product->name)

@section('css')
    <style>
        #productImageCarousel {
            height: 70vh;
        }

        @media only screen and (min-width: 768px) {
            #productImageCarousel {
                height: 95vh;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Size guild modal start -->
    <div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sizeModalLabel">
                        Hướng dẫn chọn size
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset($product->size_guild_url) }}" alt="size" class="w-100" />
                </div>
            </div>
        </div>
    </div>
    <!-- Size guild modal end -->

    <div class="container">
        <!-- Breadcrumb start -->
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('category', [$product->category->slug]) }}">{{ $product->category->name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $product->name }}
                </li>
            </ol>
        </nav>
        <!-- Breadcrumb end -->

        <!-- Product detail section start -->
        <section class="row gx-4 gy-4">
            <div class="col col-12 col-md-6">
                <!-- Product image carousel start -->
                <div id="productImageCarousel" class="carousel slide">
                    <div class="carousel-inner h-100">
                        {{-- @foreach ($product->images as $image)
                            <div class="carousel-item h-100 @if ($loop->first) active @endif">
                                <img src="{{ asset($image->image_url) }}" class="d-block w-100 h-100 object-fit-cover"
                                    alt="{{ $product->name }}" />
                            </div>
                        @endforeach --}}
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productImageCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productImageCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Product image carousel end -->
            </div>

            <div class="col col-12 col-md-6">
                <h1 class="title">{{ $product->name }}</h1>

                <div class="text-dark">Đã bán: {{ $product->sold }}</div>

                <div class="d-flex gap-3 align-items-center flex-wrap">
                    @if ($product->discount > 0)
                        <div class="fs-5 fw-bold">{{ $product->getFormatedDiscountPrice() }}đ</div>
                        <div class="text-secondary text-decoration-line-through fs-5 fw-medium">{{ $product->getFormatedPrice() }}đ
                        </div>
                        <div class="text-danger fs-6 fw-medium">-{{ $product->discount }}%</div>
                    @else
                        <div class="fs-5 fw-bold">{{ $product->getFormatedPrice() }}đ</div>
                    @endif
                </div>

                <div class="my-3">
                    <div class="text-dark mb-1">
                        Màu sắc:
                        <span class="color-name text-black fw-semibold">Đen</span>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($product->productVariants->unique('color_id') as $variant)
                            <div data-colorid="{{ $variant->color->id }}"
                                class="color-select {{ $loop->first ? 'selected' : '' }}"
                                style="background-color: {{ $variant->color->hex_code }}"></div>
                        @endforeach
                    </div>
                </div>

                @if ($product->productVariants->first()->size !== "NONE")
                    <div>
                        <div class="mb-2 d-flex justify-content-between align-items-center">
                            <div class="text-dark">
                                Kích thước:
                                <span class="text-black fw-semibold size-name"></span>
                            </div>

                            <a href="#size-guide" class="info fw-bold" data-bs-toggle="modal" data-bs-target="#sizeModal">
                                Hướng dẫn chọn size
                            </a>
                        </div>

                        <div class="sizes-container d-flex flex-wrap gap-2">

                        </div>
                    </div>
                @endif

                <div class="d-md-flex d-block justify-content-around align-items-center gap-3 my-5">
                    <div class="mb-md-0 mb-3 quantity-box">
                        <div class="quantity-decrease"><span>-</span></div>
                        <input type="number" name="quantity" id="quantity" min="1" max="50"
                            value="1" readonly />
                        <div class="quantity-increase"><span>+</span></div>
                    </div>

                    <button type="button" class="btn btn-dark flex-grow-1 w-100 loadable-btn" id="add-to-cart-btn">
                        <div class="loadable-content">
                            Thêm vào giỏ hàng
                        </div>
                        <div class="spinner spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>

                <div class="d-flex flex-column gap-3">
                    <div>
                        <h4 class="collapse-title">
                            <a role="button" data-bs-toggle="collapse" href="#description" aria-expanded="false"
                                aria-controls="description">
                                Mô tả
                            </a>
                        </h4>

                        <div id="description" class="collapse multi-collapse" role="tabpanel"
                            aria-labelledby="headingOne">
                            {{ $product->description ?? 'NULL' }}
                        </div>
                    </div>
                    <div>
                        <h4 class="collapse-title">
                            <a role="button" data-bs-toggle="collapse" href="#material" aria-expanded="false"
                                aria-controls="material">
                                Chất liệu
                            </a>
                        </h4>

                        <div id="material" class="collapse multi-collapse" role="tabpanel"
                            aria-labelledby="headingTwo">
                            {{ $product->material }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product detail section end -->

        <!-- Related products section start -->
        <section class="my-5">
            <br>
            <h3 class="text-uppercase text-center mb-3">
                Sản phẩm tương tự
            </h3>

            <div id="related-products"></div>
        </section>
        <!-- Related products section end -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.mobile.custom.min.js') }}"></script>
    <script src="{{ asset('js/MultiItemCarousel.js') }}"></script>
    <script src="{{ asset('js/QuantityBox.js') }}"></script>
    <script>
        var productId = '{{ $product->id }}';
        var variants = {!! json_encode($product->productVariants) !!};
        var images = {!! json_encode($product->images) !!};

        var csrf = '{{ csrf_token() }}';
        var domain = '{{ asset("") }}';
        var getRelatedProductsUrl = '{{ route("products.related") }}?productId={{ $product->id }}';
        var addToCartUrl = '{{ route("api.cart.store") }}';
    </script>
    <script src="{{ asset('js/product-detail.js') }}"></script>
    <script src="{{ asset('js/add-to-cart.js') }}"></script>
@endsection
