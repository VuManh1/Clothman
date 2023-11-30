@extends('layouts.admin')
@section('title', 'Quản lý Orders')

@section('content')
    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex gap-2">
                        <div class="title">
                            <h2>Orders</h2>
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
                                        Orders
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
                            {{-- <div class="btn-toolbar justify-content-between gap-3">
                                <form role="search" method="GET">
                                    <input class="form-control me-2" name="q" type="search"
                                        placeholder="Search" aria-label="Search" required>
                                </form>
                            </div> --}}

                            <div class="btn-toolbar">
                                {{-- Filter --}}
                                <form class="mb-2" method="GET">
                                    <select name="status" class="p-1 mx-1">
                                        <option value="">Status</option>
                                        <option value="PENDING">Pending</option>
                                        <option value="PROCESSING">Processing</option>
                                        <option value="SHIPPING">Shipping</option>
                                        <option value="COMPLETED">Completed</option>
                                        <option value="CANCELED">Canceled</option>
                                    </select>
                                    <select name="method" class="p-1 mx-1">
                                        <option value="">Payment Method</option>
                                        <option value="COD">COD</option>
                                        <option value="paypal">Paypal</option>
                                    </select>
                                    <select name="sort" class="p-1 mx-1">
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
                                            <th class="lead-email">
                                                <h6>#</h6>
                                            </th>
                                            <th class="lead-info">
                                                <h6>Customer Name</h6>
                                            </th>
                                            <th class="lead-info">
                                                <h6>Phone</h6>
                                            </th>
                                            <th class="lead-info">
                                                <h6>Status</h6>
                                            </th>
                                            <th class="lead-info">
                                                <h6>Date</h6>
                                            </th>
                                            <th class="lead-info">
                                                <h6>Method</h6>
                                            </th>
                                            <th>
                                                <h6>Actions</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($orders) && $orders->isNotEmpty())

                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td class="min-width">
                                                        <div class="lead">
                                                            <div class="lead-text text-nowrap">
                                                                <p>#{{ $order->code }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="min-width">
                                                        <p>{{ $order->customer_name }}</p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p>{{ $order->phone_number }}</p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p>
                                                            @switch($order->status)
                                                                @case('PENDING')
                                                                    <span class="fw-bold">{{ $order->status }}</span>
                                                                    @break
                                                                @case('PROCESSING')
                                                                    <span class="fw-bold">{{ $order->status }}</span>
                                                                    @break
                                                                @case('SHIPPING')
                                                                    <span class="fw-bold">{{ $order->status }}</span>
                                                                    @break
                                                                @case('COMPLETED')
                                                                    <span class="fw-bold text-success">{{ $order->status }}</span>
                                                                    @break
                                                                @case('CANCELED')
                                                                    <span class="fw-bold text-danger">{{ $order->status }}</span>
                                                                    @break
                                                                @default
                                                                    
                                                            @endswitch
                                                        </p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p>{{ $order->getFormatedCreatedAt() }}</p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p>{{ $order->payment->payment_method }}</p>
                                                    </td>
                                                    <td>
                                                        <div class="action gap-2">
                                                            <a href="{{ route('admin.orders.show', [$order->code]) }}"
                                                                class="btn btn-success">Detail</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                <!-- end table -->

                                @if (!isset($orders) || !$orders->isNotEmpty())
                                    <div>Không có kết quả</div>
                                @endif
                            </div>

                            {{ $orders->links() }}
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
