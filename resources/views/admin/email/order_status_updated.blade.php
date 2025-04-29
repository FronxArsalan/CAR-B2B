<div style="max-width: 600px; margin: 30px auto; padding: 30px; background: #e9f6fc; border: 1px solid #cde5f1; border-radius: 8px; font-family: Arial, sans-serif; color: #333;">

    {{-- Header with Logo --}}
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('assets/images/logo-removebg_1.png') }}" alt="Logo" style="max-width: 180px; height: auto;">
    </div>

    {{-- Greeting --}}
    <h2 style="color: #2196F3; font-size: 24px; margin-bottom: 20px;">
        Hi {{ $order->name }},
    </h2>

    {{-- Order Status Update --}}
    <p style="font-size: 16px; margin-bottom: 10px;">
        Your order <strong>#{{ $order->id }}</strong> status has been updated.
    </p>

    <p style="font-size: 16px; margin-bottom: 20px;">
        <strong>New Status:</strong> 
        <span style="color: #2196F3;">{{ ucfirst($order->status) }}</span>
    </p>

    {{-- Thank You --}}
    <p style="font-size: 16px;">
        Thank you for shopping with us!<br>
        <strong>Fronx Solutions Team</strong>
    </p>

    {{-- CTA Button --}}
    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ route('orders.view', $order->id) }}" style="display: inline-block; background-color: #2196F3; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-size: 16px;">
            View Your Order
        </a>
    </div>
</div>
