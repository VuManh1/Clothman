@extends('layouts.admin')
@section('title', 'Quản lý Categories')

@section('content')
    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Categories</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route("admin.dashboard") }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Tables
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
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="lead-info">
                                                <h6>ID</h6>
                                            </th>
                                            <th class="lead-email">
                                                <h6>Name</h6>
                                            </th>
                                        </tr>
                                        <!-- end table row-->
                                    </thead>
                                    <tbody>
                                            @if (isset($categories) && $categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td class="min-width">
                                                            <div class="lead">
                                                                <div class="lead-text">
                                                                    <p>{{ $category->id }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="min-width">
                                                            <p><a href="#0">{{ $category->name }}</a></p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                
                                            @endif
                                    </tbody>
                                </table>
                                <!-- end table -->
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
        <!-- end container -->
    </section>
@endsection
