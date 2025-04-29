<div style="max-width: 600px; margin: 30px auto; padding: 30px; background: #e9f6fc; border: 1px solid #cde5f1; border-radius: 8px; font-family: Arial, sans-serif; color: #333;">

    {{-- Header with Logo --}}
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('assets/images/logo-removebg_1.png') }}" alt="Logo" style="max-width: 180px; height: auto;">
    </div>

    {{-- Greeting --}}
    <h2 style="color: #2196F3; font-size: 28px; margin-bottom: 20px;">
        Thanks for your order, {{ $order->name }}!
    </h2>
    
    <p style="font-size: 18px; margin-bottom: 10px;">
        <strong>Order Number:</strong> #{{ $order->id }}
    </p>
    
    <p style="font-size: 18px; margin-bottom: 10px;">
        <strong>Total Amount:</strong> €{{ number_format($order->total, 2) }}
    </p>
    
    <p style="font-size: 18px; margin-bottom: 10px;">
        <strong>Order Status:</strong> {{ ucfirst($order->status) }}
    </p>
    
    {{-- CTA Button --}}
    <div style="margin-top: 30px; text-align: center;">
        <a href="" style="display: inline-block; padding: 12px 25px; background: #2196F3; color: #fff; text-decoration: none; border-radius: 5px; font-size: 16px;">
            View Order Details
        </a>
    </div>
</div>
