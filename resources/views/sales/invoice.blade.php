<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Invoice #{{ $sale->id }}</h2>
    <p>Date: {{ $sale->date }}</p>
    <p>Customer: {{ $sale->customer->name ?? 'Walk-in' }}</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>{{ $item->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align:right; margin-top:20px;">
        Total: {{ $sale->total_amount }}
    </h3>

</body>

</html>