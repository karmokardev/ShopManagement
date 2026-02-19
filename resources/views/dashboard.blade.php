@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-6">Dashboard Overview</h1>

    <div class="grid grid-cols-5 gap-6 mb-8">

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-gray-500">Total Products</h2>
            <p class="text-2xl font-bold mt-2">
                {{ $totalProducts ?? 0 }}
            </p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-gray-500">Total Stock</h2>
            <p class="text-2xl font-bold mt-2">
                {{ $totalStock ?? 0 }}
            </p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-gray-500">Total Sales</h2>
            <p class="text-2xl font-bold mt-2">
                {{ number_format($totalSales ?? 0, 2) }}
            </p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-gray-500">Total Expenses</h2>
            <p class="text-2xl font-bold mt-2">
                {{ number_format($totalExpenses ?? 0, 2) }}
            </p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-gray-500">Total Profit</h2>
            <p class="text-2xl font-bold mt-2 text-green-600">
                {{ number_format($totalProfit ?? 0, 2) }}
            </p>
        </div>

    </div>
    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-50 p-6 rounded shadow mt-8">
            <h2 class="text-xl font-bold mb-4 text-blue-700">
                📦 Top Selling Lot
            </h2>

            @if($topSellingLot)
                <p>
                    {{ $topSellingLot->purchase->product->name ?? '' }}
                    (Lot #{{ $topSellingLot->purchase_id }})
                </p>
                <p class="font-bold">
                    Sold Qty: {{ $topSellingLot->total_qty }}
                </p>
            @else
                <p>No sales yet.</p>
            @endif
        </div>

        {{-- LOW STOCK --}}
        <div class="bg-yellow-50 p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4 text-yellow-700">
                ⚠ Low Stock Lots (≤ 5)
            </h2>

            @if(($lowStockLots ?? collect())->count() > 0)
                <ul class="space-y-2">
                    @foreach($lowStockLots as $lot)
                        <li class="flex justify-between border-b pb-2">
                            <span>
                                {{ $lot->product->name }}
                                (Lot #{{ $lot->id }})
                            </span>
                            <span class="font-bold text-yellow-700">
                                {{ $lot->remaining_quantity }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No low stock lots 🎉</p>
            @endif
        </div>

        {{-- SOLD OUT --}}
        <div class="bg-red-50 p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4 text-red-700">
                ❌ Sold Out Lots
            </h2>

            @if(($soldOutLots ?? collect())->count() > 0)
                <ul class="space-y-2">
                    @foreach($soldOutLots as $lot)
                        <li class="flex justify-between border-b pb-2">
                            <span>
                                {{ $lot->product->name }}
                                (Lot #{{ $lot->id }})
                            </span>
                            <span class="font-bold text-red-700">
                                0
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No sold out lots 👍</p>
            @endif
        </div>

    </div>


    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow mt-8">
            <h2 class="text-xl font-bold mb-4">Revenue vs Expense (Monthly)</h2>
            <canvas id="revenueExpenseChart"></canvas>
        </div>
        <p class="bg-white p-6 rounded shadow mt-8 text-2xl font-bold  text-green-600">
            {{ number_format($totalProfit, 2) }}
            <span class="text-sm text-gray-500">
                ({{ $profitMargin }}%)
            </span>
        </p>

    </div>

    <script>
        new Chart(document.getElementById('monthlySalesChart'), {
            type: 'bar',
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                    label: 'Monthly Sales',
                    data: @json($monthlySales),
                    backgroundColor: 'rgba(0,128,255,0.5)'
                }]
            }
        });

        new Chart(document.getElementById('revenueExpenseChart'), {
            type: 'bar',
            data: {
                labels: @json($monthlyLabels),
                datasets: [
                    {
                        label: 'Revenue',
                        data: @json($monthlyRevenue),
                        backgroundColor: 'rgba(0,200,0,0.6)'
                    },
                    {
                        label: 'Expense',
                        data: @json($monthlyExpense),
                        backgroundColor: 'rgba(255,0,0,0.6)'
                    }
                ]
            }
        });
    </script>


@endsection