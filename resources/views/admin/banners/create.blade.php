@extends('layouts.admin')
@section('title', 'Create Banner')

@section('content')
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Create Banner</h2>
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
                                    <a href="{{ route('admin.banners.index') }}">Banners</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Create Banner
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
                        <form action="{{ route('admin.banners.store') }}" method="POST" id="create-banner-form" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3 input-style-1">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3 input-style-1">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" class="form-control" id="link" name="link">
                            </div>
                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Attach an image</label>
                                <input type="file" name="image" id="image" class="form-control">
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
            $("#create-banner-form").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "image": {
                        required: true,
                        extension: "png|jpg|jpeg|webp"
                    }
                },
                messages: {
                    "name": {
                        required: "Name không được để trống",
                    },
                    "image": {
                        required: "Ảnh không được để trống",
                        extension: "Ảnh phải có phần mở rộng là .png .jpg .jpeg hoặc .webp"
                    }
                }
            });
        });
    </script>
@endsection
