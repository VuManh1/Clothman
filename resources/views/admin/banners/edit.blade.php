@extends('layouts.admin')
@section('title', 'Edit Banner ' . $banner->name)

@section('content')
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Edit Banner: {{ $banner->name }}</h2>
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
                                    <a href="{{ route('banners.index') }}">Banners</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Edit Banner
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
                        <form action="{{ route('banners.update', [$banner->id]) }}" method="POST"
                            id="edit-cate-form" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $banner->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">link</label>
                                <input type="text" class="form-control" id="link" name="link"
                                    value="{{ $banner->link }}">
                            </div>

                            <div>Image_url</div>
                            <img src="{{ asset($banner->image_url) }}" alt="{{ $banner->name }}" class="w-100">
                            <div class="form-group mb-3">
                                <label for="image_url" class="form-label">Attach a image_url</label>
                                <input type="file" name="image_url" id="image_url" class="form-control">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                    @checked($banner->is_active)>
                                <label class="form-check-label" for="is_active">Display in home page</label>
                            </div>

                            <button type="submit" class="btn btn-success">Edit</button>
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
            $("#edit-cate-form").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "image_url": {
                        required: true,
                        extension: "png|jpg|jpeg|webp"
                    }
                },
                messages: {
                    "name": {
                        required: "Name không được để trống",
                    },
                    "image_url": {
                        required: "Ảnh không được để trống",
                        extension: "Ảnh phải có phần mở rộng là .png .jpg .jpeg hoặc .webp"
                    }
                }
            });
        });
    </script>
@endsection
