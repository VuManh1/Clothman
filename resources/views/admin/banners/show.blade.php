@extends('layouts.admin')
@section('title', 'Banner' . $banner->name)

@section('content')
    <x-modals.delete-modal id="delete-cate-modal" title="Delete this banner?"
        body="Are you sure you want to delete this banner?" action="{{ route('admin.banners.destroy', [$banner->id]) }}" />

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Banner: {{ $banner->name }}</h2>
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
                                    {{ $banner->name }}
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
                                Delete this banner
                            </button>
                        @else
                            <button class="btn btn-danger mb-4" disabled>
                                Delete this banner
                            </button>
                        @endif

                        <div class="mb-4">
                            <div class="mb-2">
                                Name:
                                <strong>{{ $banner->name }}</strong>
                            </div>
                            <div class="mb-2">
                                Created At:
                                <strong>{{ $banner->created_at }}</strong>
                            </div>
                            <div class="mb-2">
                                Link:
                                <strong>{{ $banner->link ?? 'NULL' }}</strong>
                            </div>
                            <div class="mb-2">
                                Active: 
                                <strong>{{ $banner->is_active === 1 ? 'True' : 'False' }}</strong>
                            </div>
                        </div>

                        <img src="{{ asset($banner->image_url) }}" alt="{{ $banner->name }}" class="w-100">
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
