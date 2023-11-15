@extends('layouts.admin')
@section('title', 'Color ' . $color->name)

@section('content')
    <x-modals.delete-modal id="delete-color-modal" title="Delete this Color?"
        body="Are you sure you want to delete this Color?" action="{{ route('admin.colors.destroy', [$color->id]) }}" />

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Color: {{ $color->name }}</h2>
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
                                    <a href="{{ route('admin.colors.index') }}">Colors</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Color {{ $color->name }}
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
                            <button class="btn btn-danger mb-4" data-bs-toggle="modal" data-bs-target="#delete-color-modal">
                                Delete this Color
                            </button>
                        @else
                            <button class="btn btn-danger mb-4" disabled>
                                Delete this Color
                            </button>
                        @endif

                        <div class="mb-2">
                            Name:
                            <strong>{{ $color->name }}</strong>
                        </div>
                        <div class="mb-2">
                            Hex_code:
                            <strong>{{ $color->hex_code ?? 'NULL' }}</strong>
                            <div style="background-color: {{ $color->hex_code }}; width: 50px; height: 50px; box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.3);"></div>
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
