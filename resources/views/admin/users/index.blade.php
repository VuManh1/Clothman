@extends('layouts.admin')
@section('title', 'Quản lý Users')

@section('content')
    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex gap-2">
                        <div class="title">
                            <h2>Users</h2>
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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Users
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

                            <div class="btn-toolbar justify-content-between gap-3">

                                <form role="search" method="GET">
                                    <input class="form-control me-2" name="q" type="search" placeholder="Search"
                                        aria-label="Search" required>
                                </form>

                                <a href="{{ route('admin.users.create') }}" class="btn btn-dark mb-3">Create new Staff</a>
                            </div>

                            <div class="btn-toolbar">
                                {{-- Filter --}}
                                <form class="filter-form mb-2" method="GET">
                                    <select name="is_locked" class="p-1 mx-1">
                                        <option value="">Is Locked</option>
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                    <select name="role" class="p-1 mx-1">
                                        <option value="">Role</option>
                                        <option value="CUSTOMER">Customer</option>
                                        <option value="STAFF">Staff</option>
                                        <option value="ADMIN">Admin</option>
                                    </select>
                                    <select name="sort" class="p-1 mx-1 select">
                                        <option value="">Sort By</option>
                                        <option value="name.asc">Name</option>
                                        <option value="created_at.desc">Created At</option>
                                    </select>

                                    <button type="submit" class="btn btn-dark m-1">Filter</button>
                                </form>
                            </div>

                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>Name</h6>
                                            </th>
                                            <th>
                                                <h6>Email</h6>
                                            </th>
                                            <th>
                                                <h6>Phone</h6>
                                            </th>
                                            <th>
                                                <h6>Role</h6>
                                            </th>
                                            <th>
                                                <h6>Locked</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                        <!-- end table row-->
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="min-width">
                                                    <p>{{ $user->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{  $user->email }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $user->phone_number ?? 'NULL' }}</p>
                                                </td>
                                                <td class="min-width">
                                                    @switch($user->role)
                                                        @case('CUSTOMER')
                                                            <span class="status-btn active-btn">{{ $user->role }}</span>
                                                            @break
                                                        @case('STAFF')
                                                            <span class="status-btn info-btn">{{ $user->role }}</span>
                                                            @break
                                                        @case('ADMIN')
                                                            <span class="status-btn close-btn">{{ $user->role }}</span>
                                                            @break
                                                        @default
                                                            <p>{{ $user->role }}</p>
                                                    @endswitch
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $user->is_locked ? 'True' : 'False' }}</p>
                                                </td>
                                                <td>
                                                    <div class="action gap-2">
                                                        <a href="{{ route('admin.users.show', [$user->id]) }}"
                                                            class="btn btn-success">Detail</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->

                                @if (!isset($users) || !$users->isNotEmpty())
                                    <div>Không có kết quả</div>
                                @endif

                            </div>

                            {{ $users->links() }}
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
