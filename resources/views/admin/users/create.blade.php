@extends('layouts.admin')
@section('title', 'Create User')

@section('content')
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Create User</h2>
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
                                    <a href="{{ route('admin.users.index') }}">Users</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Create User
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
                        <form action="{{ route('admin.users.store') }}" method="POST" id="create-user-form" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="mb-3 ">
                                <label for="password" class="form-label">Password</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" id="password" name="password">
                                </div>
                              </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" name="role">
                            </div>
                            <div class="mb-3">
                                <label for="info" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
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
            $("#create-user-form").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "email": {
                        required: true,
                    },
                    "phone": {
                        required: true,
                    },
                    "password": {
                        required: true,
                    }
                },
                messages: {
                    "name": {
                        required: "Name không được để trống",
                    },
                    "email": {
                        required: "Email không được để trống",
                    },
                    "phone": {
                        required: "Phone không được để trống",
                    },
                    "password": {
                        required: "Password không được để trống",
                    },

                }
            });
        });
    </script>
@endsection
