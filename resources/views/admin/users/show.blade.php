@extends('layouts.admin')
@section('title', 'User' . $User->name)

@section('content')
    <x-modals.delete-modal id="delete-cate-modal" title="Delete this User?"
        body="Are you sure you want to delete this user?" action="{{ route('admin.Users.destroy', [$User->id]) }}" />

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>User: {{ $user->name }}</h2>
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
                                    {{ $User->name }}
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
                    <div class="card-style mb-30">
                        @if (Auth::user()->role === "ADMIN")
                            <button class="btn btn-danger mb-4" data-bs-toggle="modal" data-bs-target="#delete-cate-modal">
                                Delete this User
                            </button>
                        @else
                            <button class="btn btn-danger mb-4" disabled>
                                Delete this User
                            </button>
                        @endif

                        <div class="mb-2">
                            Name:
                            <strong>{{ $user->name }}</strong>
                        </div>
                        <div class="mb-2">
                            Email:
                            <strong>{{ $user->email  }}</strong>
                        </div>
                        <div class="mb-2">
                            Phone:
                            <strong>{{ $user->phone_number }}</strong>
                        </div>
                        <div class="mb-2">
                            Password:
                            <strong>{{ $user->password  }}</strong>
                        </div>
                        <div class="mb-2">
                            Role:
                            <strong>{{ $user->role }}</strong>
                        </div>
                        <div class="mb-2">
                            Address:
                            <strong>{{ $user->address }}</strong>
                        </div>
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

@endsection
