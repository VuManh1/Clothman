@extends('layouts.admin')
@section('title', 'Product ' . $product->name)

@section('content')
    <x-modals.delete-modal id="delete-product-modal" title="Delete this product?"
        body="Are you sure you want to delete this product?" action="{{ route('products.destroy', [$product->id]) }}" />

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Product: {{ $product->name }}</h2>
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
                                    {{ $product->name }}
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
                            <button class="btn btn-danger mb-4" data-bs-toggle="modal" data-bs-target="#delete-product-modal">
                                Delete this product
                            </button>
                        @else
                            <button class="btn btn-danger mb-4" disabled>
                                Delete this product
                            </button>
                        @endif

                        <div class="mb-2">
                            Name:
                            <strong>{{ $product->name }}</strong>
                        </div>
                        <div class="mb-2">
                            Description:
                            <strong>{{ $product->description ?? 'NULL' }}</strong>
                        </div>
                        <div class="mb-4">
                            Category:
                            <strong>{{ isset($product->category) ? $product->category->name : 'NULL' }}</strong>
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
