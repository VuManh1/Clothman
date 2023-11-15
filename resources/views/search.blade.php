@extends('layouts.app')
@section('title', 'Tìm kiếm')

@section('content')
    <div class="container my-5">
        <h4 class="title mb-2">Sản phẩm</h4>
        <form class="d-flex flex-wrap gap-3">
            <div style="width: 300px;">
                <input type="text" name="value"
                    class="border-1 border-black rounded-pill py-2 px-3 bg-white d-block w-100"
                    placeholder="Tìm kiếm sản phẩm...">
            </div>
            <select class="form-select w-auto rounded-pill border-black" name="category">
                <option selected>Danh mục</option>
                <option value="1">Áo T-shirt</option>
                <option value="2">Áo Sơ Mi</option>
                <option value="3">Áo Thể Thao</option>
            </select>
        </form>

        <hr>

        <h4 class="title">Kết quả tìm kiếm: Áo</h4>

        <!-- Products section start -->
        <section class="row row-cols-2 row-cols-md-4 row-cols-lg-5 gy-4 my-3">
            <div>
                <a href="#" class="card product-item">
                    <img src="https://media.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/March2023/zzDSC05363_copy.jpg"
                        class="card-img-top product-image" alt="...">

                    <div class="card-body">
                        <h5 class="card-title">Áo khoác Daily</h5>

                        <div class="card-text d-flex gap-2 align-items-center flex-wrap">
                            <div class="text-black fw-medium">239.000đ</div>
                            <div class="d-flex gap-2 align-items-center">
                                <div class="text-secondary text-decoration-line-through fw-medium">269.000đ
                                </div>
                                <div class="text-danger fw-medium">-11%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
        <!-- Products section end -->
    </div>
@endsection