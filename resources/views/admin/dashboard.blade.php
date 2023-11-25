@extends('layouts.admin')
@section('title', "Admin Dashboard")

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
                            <h6 class="mb-10">New Orders</h6>
                            <h3 class="text-bold mb-10">34567</h3>
                            <p class="text-sm text-success">
                                <i class="lni lni-arrow-up"></i> +2.00%
                                <span class="text-gray">(30 days)</span>
                            </p>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon success">
                            <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Income</h6>
                            <h3 class="text-bold mb-10">$74,567</h3>
                            <p class="text-sm text-success">
                                <i class="lni lni-arrow-up"></i> +5.45%
                                <span class="text-gray">Increased</span>
                            </p>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-credit-cards"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Expense</h6>
                            <h3 class="text-bold mb-10">$24,567</h3>
                            <p class="text-sm text-danger">
                                <i class="lni lni-arrow-down"></i> -2.00%
                                <span class="text-gray">Expense</span>
                            </p>
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
                            <h6 class="mb-10">New User</h6>
                            <h3 class="text-bold mb-10">34567</h3>
                            <p class="text-sm text-danger">
                                <i class="lni lni-arrow-down"></i> -25.00%
                                <span class="text-gray"> Earning</span>
                            </p>
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
                                <h3 class="text-bold">$245,479</h3>
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
                        <div class="chart">
                            <canvas id="Chart1"
                                style="width: 100%; height: 400px; margin-left: -35px;"></canvas>
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
                                            <option value="">Weekly</option>
                                            <option value="">Monthly</option>
                                            <option value="">Yearly</option>
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
                                                    <img src="assets/images/products/product-mini-1.jpg"
                                                        alt="" />
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
                                                    <img src="assets/images/products/product-mini-2.jpg"
                                                        alt="" />
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
                                                    <img src="assets/images/products/product-mini-3.jpg"
                                                        alt="" />
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
                                                    <img src="assets/images/products/product-mini-4.jpg"
                                                        alt="" />
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
        // =========== chart one start
        const ctx1 = document.getElementById("Chart1").getContext("2d");
        const chart1 = new Chart(ctx1, {
          type: "line",
          data: {
            labels: [
              "Jan",
              "Fab",
              "Mar",
              "Apr",
              "May",
              "Jun",
              "Jul",
              "Aug",
              "Sep",
              "Oct",
              "Nov",
              "Dec",
            ],
            datasets: [
              {
                label: "",
                backgroundColor: "transparent",
                borderColor: "#365CF5",
                data: [
                  600, 800, 750, 880, 940, 880, 900, 770, 920, 890, 976, 1100,
                ],
                pointBackgroundColor: "transparent",
                pointHoverBackgroundColor: "#365CF5",
                pointBorderColor: "transparent",
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 5,
                borderWidth: 5,
                pointRadius: 8,
                pointHoverRadius: 8,
                cubicInterpolationMode: "monotone", // Add this line for curved line
              },
            ],
          },
          options: {
            plugins: {
              tooltip: {
                callbacks: {
                  labelColor: function (context) {
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
        // =========== chart one end
  
        // =========== chart two start
        const ctx2 = document.getElementById("Chart2").getContext("2d");
        const chart2 = new Chart(ctx2, {
          type: "bar",
          data: {
            labels: [
              "Jan",
              "Fab",
              "Mar",
              "Apr",
              "May",
              "Jun",
              "Jul",
              "Aug",
              "Sep",
              "Oct",
              "Nov",
              "Dec",
            ],
            datasets: [
              {
                label: "",
                backgroundColor: "#365CF5",
                borderRadius: 30,
                barThickness: 6,
                maxBarThickness: 8,
                data: [
                  600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
                ],
              },
            ],
          },
          options: {
            plugins: {
              tooltip: {
                callbacks: {
                  titleColor: function (context) {
                    return "#8F92A1";
                  },
                  label: function (context) {
                    let label = context.dataset.label || "";
  
                    if (label) {
                      label += ": ";
                    }
                    label += context.parsed.y;
                    return label;
                  },
                },
                backgroundColor: "#F3F6F8",
                titleAlign: "center",
                bodyAlign: "center",
                titleFont: {
                  size: 12,
                  weight: "bold",
                  color: "#8F92A1",
                },
                bodyFont: {
                  size: 16,
                  weight: "bold",
                  color: "#171717",
                },
                displayColors: false,
                padding: {
                  x: 30,
                  y: 10,
                },
            },
            },
            legend: {
              display: false,
              },
            legend: {
              display: false,
            },
            layout: {
              padding: {
                top: 15,
                right: 15,
                bottom: 15,
                left: 15,
              },
            },
            responsive: true,
            maintainAspectRatio: false,
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
                  min: 0,
                },
              },
              x: {
                grid: {
                  display: false,
                  drawBorder: false,
                  color: "rgba(143, 146, 161, .1)",
                  drawTicks: false,
                  zeroLineColor: "rgba(143, 146, 161, .1)",
                },
                ticks: {
                  padding: 20,
                },
              },
            },
            plugins: {
              legend: {
                display: false,
              },
              title: {
                display: false,
              },
            },
          },
        });
        // =========== chart two end
  
        // =========== chart three start
        const ctx3 = document.getElementById("Chart3").getContext("2d");
        const chart3 = new Chart(ctx3, {
          type: "line",
          data: {
            labels: [
              "Jan",
              "Feb",
              "Mar",
              "Apr",
              "May",
              "Jun",
              "Jul",
              "Aug",
              "Sep",
              "Oct",
              "Nov",
              "Dec",
            ],
            datasets: [
              {
                label: "Revenue",
                backgroundColor: "transparent",
                borderColor: "#365CF5",
                data: [80, 120, 110, 100, 130, 150, 115, 145, 140, 130, 160, 210],
                pointBackgroundColor: "transparent",
                pointHoverBackgroundColor: "#365CF5",
                pointBorderColor: "transparent",
                pointHoverBorderColor: "#365CF5",
                pointHoverBorderWidth: 3,
                pointBorderWidth: 5,
                pointRadius: 5,
                pointHoverRadius: 8,
                fill: false,
                tension: 0.4,
              },
              {
                label: "Profit",
                backgroundColor: "transparent",
                borderColor: "#9b51e0",
                data: [
                  120, 160, 150, 140, 165, 210, 135, 155, 170, 140, 130, 200,
                ],
                pointBackgroundColor: "transparent",
                pointHoverBackgroundColor: "#9b51e0",
                pointBorderColor: "transparent",
                pointHoverBorderColor: "#9b51e0",
                pointHoverBorderWidth: 3,
                pointBorderWidth: 5,
                pointRadius: 5,
                pointHoverRadius: 8,
                fill: false,
                tension: 0.4,
              },
              {
                label: "Order",
                backgroundColor: "transparent",
                borderColor: "#f2994a",
                data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
                pointBackgroundColor: "transparent",
                pointHoverBackgroundColor: "#f2994a",
                pointBorderColor: "transparent",
                pointHoverBorderColor: "#f2994a",
                pointHoverBorderWidth: 3,
                pointBorderWidth: 5,
                pointRadius: 5,
                pointHoverRadius: 8,
                fill: false,
                tension: 0.4,
              },
            ],
          },
          options: {
            plugins: {
              tooltip: {
                intersect: false,
                backgroundColor: "#fbfbfb",
                titleColor: "#8F92A1",
                bodyColor: "#272727",
                titleFont: {
                  size: 16,
                  family: "Plus Jakarta Sans",
                  weight: "400",
                },
                bodyFont: {
                  family: "Plus Jakarta Sans",
                  size: 16,
                },
                multiKeyBackground: "transparent",
                displayColors: false,
                padding: {
                  x: 30,
                  y: 15,
                },
                borderColor: "rgba(143, 146, 161, .1)",
                borderWidth: 1,
                enabled: true,
              },
              title: {
                display: false,
              },
              legend: {
                display: false,
              },
            },
            layout: {
              padding: {
                top: 0,
              },
            },
            responsive: true,
            // maintainAspectRatio: false,
            legend: {
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
                },
                max: 350,
                min: 50,
              },
              x: {
                grid: {
                  drawBorder: false,
                  color: "rgba(143, 146, 161, .1)",
                  drawTicks: false,
                  zeroLineColor: "rgba(143, 146, 161, .1)",
                },
                ticks: {
                  padding: 20,
                },
              },
            },
          },
        });
        // =========== chart three end
  
        // ================== chart four start
        const ctx4 = document.getElementById("Chart4").getContext("2d");
        const chart4 = new Chart(ctx4, {
          type: "bar",
          data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            datasets: [
              {
                label: "",
                backgroundColor: "#365CF5",
                borderColor: "transparent",
                borderRadius: 20,
                borderWidth: 5,
                barThickness: 20,
                maxBarThickness: 20,
                data: [600, 700, 1000, 700, 650, 800],
              },
              {
                label: "",
                backgroundColor: "#d50100",
                borderColor: "transparent",
                borderRadius: 20,
                borderWidth: 5,
                barThickness: 20,
                maxBarThickness: 20,
                data: [690, 740, 720, 1120, 876, 900],
              },
            ],
          },
          options: {
            plugins: {
              tooltip: {
                backgroundColor: "#F3F6F8",
                titleColor: "#8F92A1",
                titleFontSize: 12,
                bodyColor: "#171717",
                bodyFont: {
                  weight: "bold",
                  size: 16,
                },
                multiKeyBackground: "transparent",
                displayColors: false,
                padding: {
                  x: 30,
                  y: 10,
                },
                bodyAlign: "center",
                titleAlign: "center",
                enabled: true,
              },
              legend: {
                display: false,
              },
            },
            layout: {
              padding: {
                top: 0,
              },
            },
            responsive: true,
            // maintainAspectRatio: false,
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
                  min: 0,
                },
              },
              x: {
                grid: {
                  display: false,
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
          // =========== chart four end
      </script>
@endsection