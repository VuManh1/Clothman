@extends('layouts.admin')
@section('title', 'Category ' . $category->name)

@section('content')
    <x-modals.delete-modal id="delete-cate-modal" title="Delete this category?"
        body="Are you sure you want to delete this category?" action="{{ route('categories.destroy', [$category->id]) }}" />

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Category: {{ $category->name }}</h2>
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
                                    <a href="{{ route('categories.index') }}">Categories</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $category->name }}
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
                                Delete this category
                            </button>
                        @else
                            <button class="btn btn-danger mb-4" disabled>
                                Delete this category
                            </button>
                        @endif

                        <div class="mb-2">
                            Name:
                            <strong>{{ $category->name }}</strong>
                        </div>
                        <div class="mb-2">
                            Description:
                            <strong>{{ $category->description ?? 'NULL' }}</strong>
                        </div>
                        <div class="mb-4">
                            Parent Category:
                            <strong>{{ isset($category->parent) ? $category->parent->name : 'NULL' }}</strong>
                        </div>

                        <img src="{{ asset($category->banner_url) }}" alt="{{ $category->name }}" class="w-100">
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
