@extends('layouts.admin')
@section('title', 'Edit Color ' . $color->name)

@section('content')
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Edit Color: {{ $color->name }}</h2>
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
                                    <a href="{{ route('colors.index') }}">Colors</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Edit Color
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
                        <form action="{{ route('colors.update', [$color->id]) }}" method="POST"
                            id="edit-color-form" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $color->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="hex_code" class="form-label">hex_code</label>
                                <input type="text" class="form-control" id="hex_code" name="hex_code"
                                    value="{{ $color->hex_code }}">
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
            $("#edit-color-form").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "hex_code": {
                        required: true,
                    }
                },
                messages: {
                    "name": {
                        required: "Name không được để trống",
                    },
                    "hex_code": {
                        required: "Code không được để trống",
                    }
                }
            });
        });
    </script>
@endsection
