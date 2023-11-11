@extends('layouts.admin')
@section('title', 'Quản lý Products')

@section('content')
    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30 pb-2">
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex gap-2">
                        <div class="title">
                            <h2>Products</h2>
                        </div>
                        <form role="search" method="GET">
                            <input class="form-control me-2" name="q" type="search" placeholder="Search" aria-label="Search" required>
                        </form>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Products
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->

            <!-- ========== tables-wrapper start ========== -->
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        {{-- Filter --}}
                        <form class="filter-form mb-2" method="GET">
                            <select name="category" class="p-1 ml-1 select">
                                <option value="">Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <select name="sort" class="p-1 mx-1 select">
                                <option value="">Sort By</option>
                                <option value="created_at.desc">Created At</option>
                                <option value="price.desc">Price</option>
                            </select>
                            
                            <button type="submit" class="btn btn-success m-1">Filter</button>
                        </form>

                        <div class="card-style mb-30">
                            <div>
                                <a href="{{ route('products.create') }}" class="btn btn-dark mb-3">Create new product</a>
                            </div>

                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="lead-info">
                                                <h6>#</h6>
                                            </th>
                                            <th class="lead-email">
                                                <h6>Thumbnail</h6>
                                            </th>
                                            <th>
                                                <h6>Name</h6>
                                            </th>
                                            <th>
                                                <h6>Category</h6>
                                            </th>
                                            <th>
                                                <h6>Price</h6>
                                            </th>
                                            <th>
                                                <h6>Actions</h6>
                                            </th>
                                        </tr>
                                        <!-- end table row-->
                                    </thead>
                                    <tbody>
                                        @if (isset($products) && $products->isNotEmpty())
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->code }}</td>
                                                    <td class="min-width">
                                                        <div class="lead">
                                                            <div class="lead-image" style="border-radius: 0">
                                                                <img src="{{ asset($product->thumbnail_url) }}" alt="{{ $product->name }}" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="min-width">
                                                        <p>{{ $product->name }}</p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p>{{ $product->category->name }}</p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p>{{ $product->price }}đ</p>
                                                    </td>
                                                    <td>
                                                        <div class="action gap-2">
                                                            <a href="{{ route('products.show', [$product->id]) }}"
                                                                class="btn btn-success">Detail</a>
                                                            <a href="{{ route('products.edit', [$product->id]) }}"
                                                                class="btn btn-success">Edit</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <!-- end table -->

                                @if (!isset($products) || !$products->isNotEmpty())
                                    <div>Không có kết quả</div>
                                @endif

                            </div>

                            {{ $products->links() }}
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
@endsection
