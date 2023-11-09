@extends('layouts.admin')
@section('title', 'Create Product')

@section('content')
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Create Product</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('products.index') }}">Products</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Create Product
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
                    @include('includes.errors')

                    <div class="card-style mb-30">
                        <form action="{{ route('products.store') }}" method="POST" id="create-product-form"
                            enctype="multipart/form-data">
                            @csrf

                            <ul class="nav nav-tabs" id="product-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="main-infor-tab" data-bs-toggle="tab"
                                        data-bs-target="#main-infor-tab-pane" type="button" role="tab"
                                        aria-controls="main-infor-tab-pane" aria-selected="true">Main</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="images-tab" data-bs-toggle="tab"
                                        data-bs-target="#images-tab-pane" type="button" role="tab"
                                        aria-controls="images-tab-pane" aria-selected="false">Images</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="variants-tab" data-bs-toggle="tab"
                                        data-bs-target="#variants-tab-pane" type="button" role="tab"
                                        aria-controls="variants-tab-pane" aria-selected="false">Variants</button>
                                </li>
                            </ul>
                            <div class="tab-content py-5" id="myTabContent">
                                <div class="tab-pane fade show active" id="main-infor-tab-pane" role="tabpanel"
                                    aria-labelledby="main-infor-tab" tabindex="0">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Select category</label>
                                        <select class="mb-3 form-select" name="category_id" id="category_id"
                                            value="{{ old('category_id') }}">
                                            <option selected value="">NULL</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="images-tab-pane" role="tabpanel" aria-labelledby="images-tab"
                                    tabindex="0">
                                    images
                                </div>
                                <div class="tab-pane fade" id="variants-tab-pane" role="tabpanel" aria-labelledby="variants-tab"
                                    tabindex="0">
                                    Variants
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== tables-wrapper end ========== -->
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $().ready(function() {
            $("#create-product-form").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                },
                messages: {
                    "name": {
                        required: "Name không được để trống",
                    },
                }
            });
        });
    </script>
@endsection
