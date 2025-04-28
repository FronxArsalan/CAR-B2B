@extends('include.dashboard-layout')

@section('dashboard-content')
<div class="content-page">
    <div class="content">

        <!-- Start Content -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Checkout</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Checkout</h4>
                            </div>

                            {{-- Flash messages --}}
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('cart.placeOrder') }}" method="POST">
                                @csrf
                                <div class="row">

                                    {{-- Customer Information --}}
                                    <div class="col-md-6 mb-4">
                                        <h5>Customer Information</h5>

                                        <div class="mb-3">
                                            <label>Full Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name', $previousOrder->name ?? '') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', $previousOrder->email ?? '') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $previousOrder->phone ?? '') }}" required>
                                        </div>
                                    </div>

                                    {{-- Shipping Address --}}
                                    <div class="col-md-6 mb-4">
                                        <h5>Shipping Address</h5>

                                        <div class="mb-3">
                                            <label>Street + Number</label>
                                            <input type="text" name="shipping_address" class="form-control" value="{{ old('shipping_address', $previousOrder->shipping_address ?? '') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>City</label>
                                            <input type="text" name="shipping_city" class="form-control" value="{{ old('shipping_city', $previousOrder->shipping_city ?? '') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Postal Code</label>
                                            <input type="text" name="shipping_zip" class="form-control" value="{{ old('shipping_zip', $previousOrder->shipping_zip ?? '') }}" required>
                                        </div>
                                    </div>

                                    {{-- Billing Address Option --}}
                                    <div class="col-12 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="differentBilling" onclick="toggleBilling()">
                                            <label class="form-check-label" for="differentBilling">
                                                My billing address is different
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Billing Address --}}
                                    <div class="col-md-6 mb-4" id="billingAddress" style="display: none;">
                                        <h5>Billing Address</h5>

                                        <div class="mb-3">
                                            <label>Street + Number</label>
                                            <input type="text" name="billing_address" class="form-control" value="{{ old('billing_address', $previousOrder->billing_address ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label>City</label>
                                            <input type="text" name="billing_city" class="form-control" value="{{ old('billing_city', $previousOrder->billing_city ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label>Postal Code</label>
                                            <input type="text" name="billing_zip" class="form-control" value="{{ old('billing_zip', $previousOrder->billing_zip ?? '') }}">
                                        </div>
                                    </div>

                                    {{-- Payment Method --}}
                                    <div class="col-md-6 mb-4">
                                        <h5>Payment Method</h5>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" value="cash on delivery" id="cod" checked>
                                            <label class="form-check-label" for="cod">Cash on Delivery</label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="payment_method" value="card" id="card">
                                            <label class="form-check-label" for="card">Credit / Debit Card (coming soon)</label>
                                        </div>
                                    </div>

                                    {{-- Order Summary --}}
                                    <div class="col-md-12 mt-4">
                                        <h5>Order Summary</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Qty</th>
                                                    <th>Unit Price</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $grandTotal = 0; @endphp
                                                @foreach ($items as $item)
                                                    @php
                                                        $subtotal = $item->price * $item->quantity;
                                                        $grandTotal += $subtotal;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $item->tire->tire_size }} ({{ $item->tire->marque }})</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>€{{ number_format($item->price, 2) }}</td>
                                                        <td>€{{ number_format($subtotal, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" class="text-end"><strong>Grand Total</strong></td>
                                                    <td><strong>€{{ number_format($grandTotal, 2) }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-lg btn-success">Place Order</button>
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

{{-- JavaScript --}}
<script>
function toggleBilling() {
    var billing = document.getElementById('billingAddress');
    billing.style.display = billing.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
