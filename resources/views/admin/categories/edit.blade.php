@extends('layouts.admin')
@section('title', 'Edit Category ' . $category->name)

@section('content')
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Edit Category: {{ $category->name }}</h2>
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
                                    <a href="{{ route('admin.categories.index') }}">Categories</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Edit Category
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
                        <form action="{{ route('admin.categories.update', [$category->id]) }}" method="POST"
                            id="edit-cate-form" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $category->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ $category->description }}">
                            </div>
                            <div class="mb-3">
                                <label for="parent_id" class="form-label">Select parent category</label>
                                <select class="mb-3 form-select" name="parent_id" id="parent_id"
                                    value="{{ $category->parent_id }}">
                                    <option selected value="">NULL</option>
                                    @foreach ($categories as $cate)
                                        @if ($cate->id !== $category->id)
                                            <option value="{{ $cate->id }}" @selected($category->parent_id === $cate->id)>
                                                {{ $cate->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div>Banner</div>
                            <img src="{{ asset($category->banner_url) }}" alt="{{ $category->name }}" class="w-100">
                            <div class="form-group mb-3">
                                <label for="banner" class="form-label">Attach a banner image</label>
                                <input type="file" name="banner" id="banner" class="form-control">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="display_in_home" name="display_in_home"
                                    @checked($category->display_in_home)>
                                <label class="form-check-label" for="display_in_home">Display in home page</label>
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
                    "banner": {
                        extension: "png|jpg|jpeg|webp"
                    }
                },
                messages: {
                    "name": {
                        required: "Name không được để trống",
                    },
                    "banner": {
                        extension: "Banner phải có phần mở rộng là .png .jpg .jpeg hoặc .webp"
                    }
                }
            });
        });
    </script>
@endsection
