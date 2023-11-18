@extends('layouts.admin')
@section('title', 'Quản lý Banners')

@section('content')
    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex gap-2">
                        <div class="title">
                            <h2>Banners</h2>
                        </div>
                        {{-- <form role="search" method="GET">
                            <input class="form-control me-2" name="q" type="search" placeholder="Search"
                                aria-label="Search" required>
                        </form> --}}
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Banners
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
                            <div class="card-style mb-30">

                                <div class="btn-toolbar justify-content-between">

                                    <form role="search" method="GET">
                                        <input class="btn btn-outline-secondary" name="q" type="search"
                                            placeholder="Search" aria-label="Search" required>
                                    </form>

                                    <a href="{{ route('admin.banners.create') }}" class="btn btn-dark mb-3">Create new
                                        banner</a>
                                </div>

                                <div class="btn-toolbar justify-content-between">
                                    {{-- Filter --}}
                                    <form class="filter-form mb-2 mx-auto" method="GET">
                                        <select name="is_active" class="p-1 mx-1 select">
                                            <option value="">Status</option>
                                            <option value="true">Active</option>
                                            <option value="false">Not Active</option>
                                        </select>
                                        <select name="sort" class="p-1 mx-1 select">
                                            <option value="">Sort By</option>
                                            <option value="name.asc">Name</option>
                                            <option value="created_at.desc">Created At</option>
                                        </select>

                                        <button type="submit" class="btn btn-dark m-1">Filter</button>
                                    </form>
                                </div>
                                {{-- <div>
                                <a href="{{ route('admin.banners.create') }}" class="btn btn-dark mb-3">Create new banner</a>
                            </div> --}}

                                <div class="table-wrapper table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="lead-info">
                                                    <h6>#</h6>
                                                </th>
                                                <th class="lead-email">
                                                    <h6>Name</h6>
                                                </th>
                                                <th class="lead-link">
                                                    <h6>Link</h6>
                                                </th>
                                                <th>
                                                    <h6>Actions</h6>
                                                </th>
                                            </tr>
                                            <!-- end table row-->
                                        </thead>
                                        <tbody>
                                            @if (isset($banners) && $banners->isNotEmpty())
                                                @foreach ($banners as $banner)
                                                    <tr>
                                                        <td class="min-width">
                                                            <div class="lead">
                                                                <div class="lead-image" style="border-radius: 0">
                                                                    <img src="{{ asset($banner->image_url) }}"
                                                                        alt="{{ $banner->name }}" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="min-width">
                                                            <p>{{ $banner->name }}</p>
                                                        </td>
                                                        <td class="min-width">
                                                            <div class="lead">
                                                                <div class="lead-link">
                                                                    <p>{{ $banner->link }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="action gap-2">
                                                                <a href="{{ route('admin.banners.show', [$banner->id]) }}"
                                                                    class="btn btn-success">Detail</a>
                                                                <a href="{{ route('admin.banners.edit', [$banner->id]) }}"
                                                                    class="btn btn-success">Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <!-- end table -->

                                    @if (!isset($banners) || !$banners->isNotEmpty())
                                        <div>Không có kết quả</div>
                                    @endif

                                </div>

                                {{ $banners->links() }}
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== tables-wrapper end ========== -->
            </div>
            <!-- end container -->
    </section>
@endsection
