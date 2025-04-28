<div style="max-width: 600px; margin: 30px auto; padding: 30px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; font-family: Arial, sans-serif; color: #333;">
    <h2 style="color: #4CAF50; font-size: 28px; margin-bottom: 20px;">
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
    
    <div style="margin-top: 30px; text-align: center;">
        <a href="" style="display: inline-block; padding: 12px 25px; background: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px; font-size: 16px;">
            View Order Details
        </a>
    </div>
</div>
