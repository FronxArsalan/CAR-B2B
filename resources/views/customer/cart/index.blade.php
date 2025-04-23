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
                            <h4 class="page-title">Tires</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tires</a></li>
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
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">Your Cart</h4>
                                </div>
                                @if ($items->count())
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tire</th>
                                                <th>Type</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Subtotal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $total = 0; @endphp
                                            @foreach ($items as $item)
                                                @php
                                                    $subtotal = $item->price * $item->quantity;
                                                    $total += $subtotal;
                                                @endphp
                                                <tr>
                                                    <td>{{ $item->tire->tire_size }} ({{ $item->tire->marque }})</td>
                                                    <td>{{ ucfirst($item->tire->type ?? '-') }}</td>
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('cart.update', $item->tire_id) }}">
                                                            @csrf
                                                            <input type="number" name="quantity"
                                                                value="{{ $item->quantity }}" min="1"
                                                                style="width: 60px;">
                                                            <button class="btn btn-sm btn-outline-primary">Update</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        @if ($item->price < $item->tire->prix)
                                                            <span
                                                                class="text-success fw-bold">€{{ number_format($item->price, 2) }}</span><br>
                                                            <small
                                                                class="text-muted"><del>€{{ number_format($item->tire->prix, 2) }}</del></small>
                                                        @else
                                                            €{{ number_format($item->price, 2) }}
                                                        @endif
                                                    </td>
                                                    <td>€{{ number_format($subtotal, 2) }}</td>
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('cart.remove', $item->tire_id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger">Remove</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                                <td colspan="2"><strong>€{{ number_format($total, 2) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="text-end">
                                        <form method="POST" action="{{ route('cart.clear') }}"
                                            style="display: inline-block;">
                                            @csrf
                                            <button class="btn btn-warning btn-sm">Clear Cart</button>
                                        </form>
                                        <a href="{{ route('cart.checkout') }}" class="btn btn-success">Proceed to Checkout</a>
                                    </div>
                                @else
                                    <p>Your cart is empty.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
