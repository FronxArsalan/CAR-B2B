{{-- // resources/views/tires/index.blade.php --}}
@extends('include.dashboard-layout')
@section('dashboard-content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div
                            class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                            <h4 class="page-title">Order #{{ $order->id }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header fw-bold">Customer Info</div>
                            <div class="card-body">
                                <p><strong>Name:</strong> {{ $order->name }}</p>
                                <p><strong>Email:</strong> {{ $order->email }}</p>
                                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                            </div>
                        </div>
                        {{-- Shipping Info --}}
                        <div class="card mb-3">
                            <div class="card-header fw-bold">Shipping Address</div>
                            <div class="card-body">
                                <p>{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_state }}
                                    - {{ $order->shipping_zip }}, {{ $order->shipping_country }}</p>
                            </div>
                        </div>

                        {{-- Billing Info --}}
                        <div class="card mb-3">
                            <div class="card-header fw-bold">Billing Address</div>
                            <div class="card-body">
                                <p>{{ $order->billing_address }}, {{ $order->billing_city }}, {{ $order->billing_state }}
                                    - {{ $order->billing_zip }}, {{ $order->billing_country }}</p>
                            </div>
                        </div>

                        {{-- Order Items --}}
                        <div class="card mb-3">
                            <div class="card-header fw-bold">Order Items</div>
                            <div class="card-body p-0">
                                <table class="table table-bordered m-0">
                                    <thead>
                                        <tr>
                                            <th>Tire</th>
                                            <th>Brand</th>
                                            <th>Qty</th>
                                            <th>Unit Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach ($order->items as $item)
                                            @php
                                                $subtotal = $item->price * $item->quantity;
                                                $total += $subtotal;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->tire->tire_size ?? '-' }}</td>
                                                <td>{{ $item->tire->marque ?? '-' }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>€{{ number_format($item->price, 2) }}</td>
                                                <td>€{{ number_format($subtotal, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-end fw-bold">Total</td>
                                            <td class="fw-bold">€{{ number_format($total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Status Update --}}
                        <div class="card">
                            <div class="card-header fw-bold">Order Status</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.orders.status', $order->id) }}">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <select name="status" class="form-select">
                                                @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                                    <option value="{{ $status }}"
                                                        {{ $order->status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">Update Status</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
