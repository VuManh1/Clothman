@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Clothman Dashboard</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Dashboard
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
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon purple">
                            <i class="lni lni-cart-full"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">New Orders Today</h6>
                            <h3 class="text-bold mb-10" id="newOrdersCount">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon orange">
                            <i class="lni lni-user"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">New User Today</h6>
                            <h3 class="text-bold mb-10" id="newUserCount">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
            <div class="row">
                <div class="w-100">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left">
                                <h6 class="text-medium mb-10">Yearly Stats</h6>
                                <h3 class="text-bold" id="yearlyStatsTotal">0đ</h3>
                            </div>
                        </div>
                        <!-- End Title -->
                        <div class="chart position-relative" id="yearlyStatsContent">
                            <div class="spinner spinner-grow text-primary position-absolute top-50 start-50 translate-middle"
                                role="status" style="width: 70px; height: 70px; trans">
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            <canvas id="yearlyStatsChart" style="width: 100%; height: 400px; margin-left: -35px;"></canvas>
                        </div>
                        <!-- End Chart -->
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
            <div class="row">
                <!-- End Col -->
                <div class="w-100">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap justify-content-between align-items-center">
                            <div class="left">
                                <h6 class="text-medium mb-30">Top Selling Products</h6>
                            </div>
                            <div class="right">
                                <div class="select-style-1">
                                    <div class="select-position select-sm">
                                        <select class="light-bg">
                                            <option value="">Yearly</option>
                                            <option value="">Monthly</option>
                                            <option value="">Weekly</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end select -->
                            </div>
                        </div>
                        <!-- End Title -->
                        <div class="table-responsive">
                            <table class="table top-selling-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6 class="text-sm text-medium">Products</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Category</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Price</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Sold</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="image">
                                                    <img src="assets/images/products/product-mini-1.jpg" alt="" />
                                                </div>
                                                <p class="text-sm">Arm Chair</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm">Interior</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$345</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">43</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="image">
                                                    <img src="assets/images/products/product-mini-2.jpg" alt="" />
                                                </div>
                                                <p class="text-sm">SOfa</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm">Interior</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$145</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">13</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="image">
                                                    <img src="assets/images/products/product-mini-3.jpg" alt="" />
                                                </div>
                                                <p class="text-sm">Dining Table</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm">Interior</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$95</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">32</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="image">
                                                    <img src="assets/images/products/product-mini-4.jpg" alt="" />
                                                </div>
                                                <p class="text-sm">Office Chair</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm">Interior</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$105</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">23</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table -->
                        </div>
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- end container -->
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script>
        $(function() {
            $.get("{{ route('api.dashboard') }}", function(data, status) {
                if (status === 'success') {
                    const dashboardData = data.data;

                    $('#newOrdersCount').html(dashboardData.new_orders_count);
                    $('#newUserCount').html(dashboardData.new_users_count);

                    if (dashboardData.yearly_stats) {
                        renderYearlyStats(dashboardData.yearly_stats);
                    }
                }
            });
        });

        function renderYearlyStats(stats) {
            $('#yearlyStatsContent').find('.spinner').hide();
            $('#yearlyStatsTotal').html(stats.total);

            const months = stats.data.map(d => d.month);
            const amounts = stats.data.map(d => d.total);

            const ctx1 = document.getElementById("yearlyStatsChart").getContext("2d");
            const yearlyStatsChart = new Chart(ctx1, {
                type: "line",
                data: {
                    labels: months,
                    datasets: [{
                        label: "",
                        backgroundColor: "transparent",
                        borderColor: "#365CF5",
                        data: amounts,
                        pointBackgroundColor: "transparent",
                        pointHoverBackgroundColor: "#365CF5",
                        pointBorderColor: "transparent",
                        pointHoverBorderColor: "#fff",
                        pointHoverBorderWidth: 5,
                        borderWidth: 5,
                        pointRadius: 8,
                        pointHoverRadius: 8,
                        cubicInterpolationMode: "monotone", // Add this line for curved line
                    }, ],
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                labelColor: function(context) {
                                    return {
                                        backgroundColor: "#ffffff",
                                        color: "#171717"
                                    };
                                },
                            },
                            intersect: false,
                            backgroundColor: "#f9f9f9",
                            title: {
                                fontFamily: "Plus Jakarta Sans",
                                color: "#8F92A1",
                                fontSize: 12,
                            },
                            body: {
                                fontFamily: "Plus Jakarta Sans",
                                color: "#171717",
                                fontStyle: "bold",
                                fontSize: 16,
                            },
                            multiKeyBackground: "transparent",
                            displayColors: false,
                            padding: {
                                x: 30,
                                y: 10,
                            },
                            bodyAlign: "center",
                            titleAlign: "center",
                            titleColor: "#8F92A1",
                            bodyColor: "#171717",
                            bodyFont: {
                                family: "Plus Jakarta Sans",
                                size: "16",
                                weight: "bold",
                            },
                        },
                        legend: {
                            display: false,
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: false,
                    },
                    scales: {
                        y: {
                            grid: {
                                display: false,
                                drawTicks: false,
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 35,
                                max: 1200,
                                min: 500,
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                color: "rgba(143, 146, 161, .1)",
                                zeroLineColor: "rgba(143, 146, 161, .1)",
                            },
                            ticks: {
                                padding: 20,
                            },
                        },
                    },
                },
            });
        }
    </script>
@endsection
