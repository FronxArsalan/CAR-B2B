@extends('include.dashboard-layout')
@section('dashboard-content')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                {{-- @if ($lowStockTires->count())
                    <div class="alert alert-warning">
                        <strong>⚠️ Low Stock Alert</strong>
                        <ul>
                            @foreach ($lowStockTires as $tire)
                                <li>{{ $tire->tire_size }} ({{ $tire->marque }}) — Only {{ $tire->quantite }} left</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="alert alert-success">All tires are sufficiently stocked ✅</div>
                @endif --}}
                <div class="row">
                    <div class="col-12">
                        <div
                            class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                            <h4 class="page-title">Dashboard</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>

                            </ol>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->role == 'admin')
                    <div class="row">

                        {{-- Total Orders --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">Total Orders</h5>
                                            <h3 class="my-3">{{ $totalOrders }}</h3>
                                            <p class="mb-0 text-muted text-truncate">
                                                @if ($orderGrowth > 0)
                                                    <span class="badge bg-success me-1">
                                                        <i class="ri-arrow-up-line"></i> +{{ $orderGrowth }}%
                                                    </span>
                                                    Since last month
                                                @elseif ($orderGrowth < 0)
                                                    <span class="badge bg-danger me-1">
                                                        <i class="ri-arrow-down-line"></i> {{ $orderGrowth }}%
                                                    </span>
                                                    Dropped from last month
                                                @else
                                                    <span class="badge bg-secondary me-1">
                                                        <i class="ri-subtract-line"></i> 0%
                                                    </span>
                                                    No change from last month
                                                @endif
                                            </p>

                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-shopping-bag-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Total Sales --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">Total Sales</h5>
                                            <h3 class="my-3">€{{ number_format($totalSales, 2) }}</h3>
                                            <p class="mb-0 text-muted text-truncate">
                                                @if ($salesGrowth > 0)
                                                    <span class="badge bg-primary me-1">
                                                        <i class="ri-arrow-up-line"></i> +{{ $salesGrowth }}%
                                                    </span>
                                                    Higher than last month
                                                @elseif ($salesGrowth < 0)
                                                    <span class="badge bg-danger me-1">
                                                        <i class="ri-arrow-down-line"></i> {{ $salesGrowth }}%
                                                    </span>
                                                    Dropped from last month
                                                @else
                                                    <span class="badge bg-secondary me-1">
                                                        <i class="ri-subtract-line"></i> 0%
                                                    </span>
                                                    Same as last month
                                                @endif
                                            </p>

                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-currency-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Pending Orders --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">Pending Orders</h5>
                                            <h3 class="my-3">{{ $pendingOrders }}</h3>
                                            <p class="mb-0 text-muted text-truncate">
                                                <span class="badge bg-warning me-1"><i class="ri-time-line"></i> </span>
                                                Waiting for Processing
                                            </p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-timer-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Shipped Orders --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">Shipped Orders</h5>
                                            <h3 class="my-3">{{ $shippedOrders }}</h3>
                                            <p class="mb-0 text-muted text-truncate">
                                                <span class="badge bg-info me-1"><i class="ri-truck-line"></i></span>
                                                On the way
                                            </p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-truck-fill"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Delivered Orders --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">Delivered Orders</h5>
                                            <h3 class="my-3">{{ $deliveredOrders }}</h3>
                                            <p class="mb-0 text-muted text-truncate">
                                                <span class="badge bg-dark me-1"><i class="ri-check-double-line"></i></span>
                                                Completed
                                            </p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-dark rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-check-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Cancelled Orders --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">Cancelled Orders</h5>
                                            <h3 class="my-3">{{ $cancelledOrders }}</h3>
                                            <p class="mb-0 text-muted text-truncate">
                                                <span class="badge bg-danger me-1"><i class="ri-close-line"></i></span>
                                                Canceled
                                            </p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-close-circle-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Daily Sales Widget --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">Today's Sales</h5>
                                            <h3 class="my-3">€{{ number_format($salesToday, 2) }}</h3>
                                            <p class="text-muted">Orders: <strong>{{ $ordersToday }}</strong></p>
                                            <p class="mb-0 text-muted text-truncate">
                                                @if ($dailySalesGrowth > 0)
                                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                        +{{ $dailySalesGrowth }}%</span>
                                                    Growth from yesterday
                                                @elseif ($dailySalesGrowth < 0)
                                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                        {{ $dailySalesGrowth }}%</span>
                                                    Drop from yesterday
                                                @else
                                                    <span class="badge bg-secondary me-1"><i class="ri-subtract-line"></i>
                                                        0%</span>
                                                    Same as yesterday
                                                @endif
                                            </p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-calendar-check-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Today's Orders Widget --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">Today's Orders</h5>
                                            <h3 class="my-3">{{ $ordersToday }}</h3>
                                            <p class="mb-0 text-muted text-truncate">
                                                <span class="badge bg-info me-1"><i class="ri-bar-chart-line"></i></span>
                                                Processed Today
                                            </p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-order-play-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- This Week Sales --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">This Week's Sales</h5>
                                            <h3 class="my-3">€{{ number_format($salesThisWeek, 2) }}</h3>
                                            <p class="text-muted">Orders: <strong>{{ $ordersThisWeek }}</strong></p>
                                            <p class="mb-0 text-muted text-truncate">
                                                @if ($weeklyGrowth > 0)
                                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                        +{{ $weeklyGrowth }}%</span>
                                                    Growth from last week
                                                @elseif ($weeklyGrowth < 0)
                                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                        {{ $weeklyGrowth }}%</span>
                                                    Drop from last week
                                                @else
                                                    <span class="badge bg-secondary me-1"><i class="ri-subtract-line"></i>
                                                        0%</span>
                                                    Same as last week
                                                @endif
                                            </p>

                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-calendar-event-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- This Month Sales --}}
                        <div class="col-md-4 mb-3">
                            <div class="card widget-icon-box">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-muted text-uppercase fs-13 mt-0">This Month's Sales</h5>
                                            <h3 class="my-3">€{{ number_format($salesThisMonth, 2) }}</h3>
                                            <p class="text-muted">Orders: <strong>{{ $ordersThisMonth }}</strong></p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                <i class="ri-calendar-month-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Low Stock Tires Table --}}
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Low Stock Tires</h4>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                                <tr>
                                                    <th class="py-1">Product</th>
                                                    <th class="py-1">Price</th>
                                                    <th class="py-1">Stock</th>
                                                    <th class="py-1">Brand</th>
                                                    <th class="py-1">Size</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($lowStockList as $tire)
                                                    <tr>
                                                        <td>{{ $tire->nr_article }}</td>
                                                        <td>€{{ number_format($tire->prix, 2) }}</td>
                                                        <td><span class="badge bg-danger">{{ $tire->quantite }}</span>
                                                        </td>
                                                        <td>{{ $tire->marque }}</td>
                                                        <td>{{ $tire->tire_size }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted">No low stock
                                                            tires
                                                            🚗
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('tires.inventory') }}"
                                            class="text-primary text-decoration-underline fw-bold btn mb-2">View All
                                            Tires</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Best Selling Tires --}}
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Best Selling Tires</h4>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Brand</th>
                                                    <th>Sold Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bestSellingTires as $tire)
                                                    <tr>
                                                        <td>{{ $tire->tire_size }}</td>
                                                        <td>{{ $tire->marque }}</td>
                                                        <td><span class="badge bg-success">{{ $tire->total_sold }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @if ($bestSellingTires->isEmpty())
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted">No data yet 📉
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mb-4">Monthly Sales</h4>
                                    <div dir="ltr">
                                        <div id="stacked-area" class="apex-charts" data-colors="#4254ba,#17a497,#e3eaef">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->role == 'stock_manager')
                <div class="row">
                    {{-- Daily Sales Widget --}}
                    <div class="col-md-4 mb-3">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0">Today's Sales</h5>
                                        <h3 class="my-3">€{{ number_format($salesToday, 2) }}</h3>
                                        <p class="text-muted">Orders: <strong>{{ $ordersToday }}</strong></p>
                                        <p class="mb-0 text-muted text-truncate">
                                            @if ($dailySalesGrowth > 0)
                                                <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                    +{{ $dailySalesGrowth }}%</span>
                                                Growth from yesterday
                                            @elseif ($dailySalesGrowth < 0)
                                                <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                    {{ $dailySalesGrowth }}%</span>
                                                Drop from yesterday
                                            @else
                                                <span class="badge bg-secondary me-1"><i class="ri-subtract-line"></i>
                                                    0%</span>
                                                Same as yesterday
                                            @endif
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                            <i class="ri-calendar-check-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Today's Orders Widget --}}
                    <div class="col-md-4 mb-3">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0">Today's Orders</h5>
                                        <h3 class="my-3">{{ $ordersToday }}</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-info me-1"><i class="ri-bar-chart-line"></i></span>
                                            Processed Today
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                            <i class="ri-order-play-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- This Week Sales --}}
                    <div class="col-md-4 mb-3">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0">This Week's Sales</h5>
                                        <h3 class="my-3">€{{ number_format($salesThisWeek, 2) }}</h3>
                                        <p class="text-muted">Orders: <strong>{{ $ordersThisWeek }}</strong></p>
                                        <p class="mb-0 text-muted text-truncate">
                                            @if ($weeklyGrowth > 0)
                                                <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                    +{{ $weeklyGrowth }}%</span>
                                                Growth from last week
                                            @elseif ($weeklyGrowth < 0)
                                                <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                    {{ $weeklyGrowth }}%</span>
                                                Drop from last week
                                            @else
                                                <span class="badge bg-secondary me-1"><i class="ri-subtract-line"></i>
                                                    0%</span>
                                                Same as last week
                                            @endif
                                        </p>

                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                            <i class="ri-calendar-event-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- This Month Sales --}}
                    <div class="col-md-4 mb-3">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0">This Month's Sales</h5>
                                        <h3 class="my-3">€{{ number_format($salesThisMonth, 2) }}</h3>
                                        <p class="text-muted">Orders: <strong>{{ $ordersThisMonth }}</strong></p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                            <i class="ri-calendar-month-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                {{-- Low Stock Tires Table --}}
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <h4 class="header-title">Low Stock Tires</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                    <thead class="border-top border-bottom bg-light-subtle border-light">
                                        <tr>
                                            <th class="py-1">Product</th>
                                            <th class="py-1">Price</th>
                                            <th class="py-1">Stock</th>
                                            <th class="py-1">Brand</th>
                                            <th class="py-1">Size</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($lowStockList as $tire)
                                            <tr>
                                                <td>{{ $tire->nr_article }}</td>
                                                <td>€{{ number_format($tire->prix, 2) }}</td>
                                                <td><span class="badge bg-danger">{{ $tire->quantite }}</span>
                                                </td>
                                                <td>{{ $tire->marque }}</td>
                                                <td>{{ $tire->tire_size }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No low stock
                                                    tires
                                                    🚗
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('tires.inventory') }}"
                                    class="text-primary text-decoration-underline fw-bold btn mb-2">View All
                                    Tires</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Best Selling Tires --}}
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <h4 class="header-title">Best Selling Tires</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                    <thead class="border-top border-bottom bg-light-subtle border-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Brand</th>
                                            <th>Sold Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bestSellingTires as $tire)
                                            <tr>
                                                <td>{{ $tire->tire_size }}</td>
                                                <td>{{ $tire->marque }}</td>
                                                <td><span class="badge bg-success">{{ $tire->total_sold }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($bestSellingTires->isEmpty())
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No data yet 📉
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">Monthly Sales</h4>
                            <div dir="ltr">
                                <div id="stacked-area" class="apex-charts" data-colors="#4254ba,#17a497,#e3eaef">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            @if (Auth::user()->role == 'user')
                <div class="row">

                    {{-- Total Orders --}}
                    <div class="col-md-4 mb-3">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0">Total Orders</h5>
                                        <h3 class="my-3">{{ $totalOrdersUser }}</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            @if ($orderGrowth > 0)
                                                <span class="badge bg-success me-1">
                                                    <i class="ri-arrow-up-line"></i> +{{ $orderGrowth }}%
                                                </span>
                                                Since last month
                                            @elseif ($orderGrowth < 0)
                                                <span class="badge bg-danger me-1">
                                                    <i class="ri-arrow-down-line"></i> {{ $orderGrowth }}%
                                                </span>
                                                Dropped from last month
                                            @else
                                                <span class="badge bg-secondary me-1">
                                                    <i class="ri-subtract-line"></i> 0%
                                                </span>
                                                No change from last month
                                            @endif
                                        </p>

                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                            <i class="ri-shopping-bag-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- Pending Orders --}}
                    <div class="col-md-4 mb-3">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0">Pending Orders</h5>
                                        <h3 class="my-3">{{ $pendingOrdersUser }}</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-warning me-1"><i class="ri-time-line"></i> </span>
                                            Waiting for Processing
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                            <i class="ri-timer-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Shipped Orders --}}
                    <div class="col-md-4 mb-3">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0">Shipped Orders</h5>
                                        <h3 class="my-3">{{ $shippedOrdersUser }}</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-info me-1"><i class="ri-truck-line"></i></span>
                                            On the way
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                            <i class="ri-truck-fill"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Delivered Orders --}}
                    <div class="col-md-4 mb-3">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0">Delivered Orders</h5>
                                        <h3 class="my-3">{{ $deliveredOrdersUser }}</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-dark me-1"><i class="ri-check-double-line"></i></span>
                                            Completed
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title text-bg-dark rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                            <i class="ri-check-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Cancelled Orders --}}
                    <div class="col-md-4 mb-3">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0">Cancelled Orders</h5>
                                        <h3 class="my-3">{{ $cancelledOrdersUser }}</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-danger me-1"><i class="ri-close-line"></i></span>
                                            Canceled
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                            <i class="ri-close-circle-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>












                </div>
            @endif
        </div>
        <!-- container -->

    </div>
    <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Jidox - Coderthemes.com
                </div>
                <div class="col-md-6">
                    <div class="text-md-end footer-links d-none d-md-block">
                        <a href="javascript: void(0);">About</a>
                        <a href="javascript: void(0);">Support</a>
                        <a href="javascript: void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    @section('scripts')
        <script>
            const stackedAreaOptions = {
                chart: {
                    height: 350,
                    type: 'area',
                    stacked: true,
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#4254ba', '#17a497', '#e3eaef'],
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                series: [{
                        name: 'Sales (€)',
                        data: {!! json_encode($salesChartData) !!}
                    },
                    {
                        name: 'Orders',
                        data: {!! json_encode($ordersChartData) !!}
                    },
                    {
                        name: 'Revenue',
                        data: {!! json_encode($revenueChartData) !!}
                    }
                ],
                xaxis: {
                    categories: {!! json_encode($salesChartLabels) !!},
                    title: {
                        text: 'Date'
                    },
                    labels: {
                        rotate: -45
                    }
                },
                yaxis: {
                    title: {
                        text: 'Values'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        opacityFrom: 0.5,
                        opacityTo: 0.1,
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(val) {
                            return "€" + val;
                        }
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#stacked-area"), stackedAreaOptions);
            chart.render();

            // 🔄 Dashboard stats auto-refresh every 30 seconds
            setInterval(() => {
                fetch('/api/dashboard-stats')
                    .then(res => res.json())
                    .then(data => {
                        // ✅ Yahan tum updated values ko chart mein inject kar sakte ho
                        // e.g., chart.updateSeries(...) ya DOM update
                        console.log('Dashboard updated', data);
                    })
                    .catch(err => {
                        console.error('Failed to fetch dashboard stats', err);
                    });
            }, 30000); // 30 seconds
        </script>
    @endsection
@endsection
