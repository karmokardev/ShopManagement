@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-6">Dashboard Overview</h1>

    <div class="grid grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-gray-500">Total Products</h2>
            <p class="text-2xl font-bold mt-2">{{ $totalProducts }}</p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-gray-500">Total Sales</h2>
            <p class="text-2xl font-bold mt-2">{{ $totalSales }}</p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-gray-500">Total Expenses</h2>
            <p class="text-2xl font-bold mt-2">{{ $totalExpenses }}</p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-gray-500">Total Profit</h2>
            <p class="text-2xl font-bold mt-2 text-green-600">
                {{ $totalProfit }}
            </p>
        </div>

    </div>

    <div class="grid grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Sales (Last 7 Days)</h2>
            <canvas id="salesChart"></canvas>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Expenses (Last 7 Days)</h2>
            <canvas id="expenseChart"></canvas>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const dates = @json($dates ?? []);
            const salesData = @json($salesData ?? []);
            const expenseData = @json($expenseData ?? []);

            new Chart(document.getElementById('salesChart'), {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Sales',
                        data: salesData,
                        borderColor: 'green',
                        backgroundColor: 'rgba(0,128,0,0.2)',
                        fill: true
                    }]
                }
            });

            new Chart(document.getElementById('expenseChart'), {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Expenses',
                        data: expenseData,
                        borderColor: 'red',
                        backgroundColor: 'rgba(255,0,0,0.2)',
                        fill: true
                    }]
                }
            });

        });
    </script>

@endsection