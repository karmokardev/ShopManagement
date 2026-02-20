@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">Financial Report</h1>

        {{-- Today --}}
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="font-semibold mb-3">Today</h2>

            <p>Sales: ৳ {{ number_format($dailySales, 2) }}</p>
            <p>COGS: ৳ {{ number_format($dailyCOGS, 2) }}</p>
            <p>Expenses: ৳ {{ number_format($dailyExpenses, 2) }}</p>

            <p class="font-bold text-lg mt-2">
                Profit: ৳ {{ number_format($dailyProfit, 2) }}
            </p>
        </div>

        {{-- Monthly --}}
        <div class="bg-white p-6 rounded shadow">
            <h2 class="font-semibold mb-3">This Month</h2>

            <p>Sales: ৳ {{ number_format($monthlySales, 2) }}</p>
            <p>COGS: ৳ {{ number_format($monthlyCOGS, 2) }}</p>
            <p>Expenses: ৳ {{ number_format($monthlyExpenses, 2) }}</p>

            <p class="font-bold text-lg mt-2">
                Profit: ৳ {{ number_format($monthlyProfit, 2) }}
            </p>
        </div>

    </div>

@endsection