<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h2 { margin-bottom: 0; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h2>Invoice #{{ $order->id }}</h2>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>

    <h4>Billing Info</h4>
    <p>
        {{ $order->name }}<br>
        {{ $order->billing_address }}, {{ $order->billing_city }}, {{ $order->billing_state }} - {{ $order->billing_zip }}<br>
        {{ $order->billing_country }}<br>
        {{ $order->email }} | {{ $order->phone }}
    </p>

    <h4>Order Items</h4>
    <table>
        <thead>
            <tr>
                <th>Tire</th>
                <th>Qty</th>
                <th>Unit Price (€)</th>
                <th>Subtotal (€)</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($order->items as $item)
                @php $sub = $item->price * $item->quantity; $total += $sub; @endphp
                <tr>
                    <td>{{ $item->tire->tire_size ?? '-' }} ({{ $item->tire->marque ?? '-' }})</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($sub, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right"><strong>Total</strong></td>
                <td><strong>€{{ number_format($total, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
