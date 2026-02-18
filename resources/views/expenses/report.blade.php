@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-6">Financial Report</h1>

    <div class="grid grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Today</h2>
            <p>Sales: {{ $dailySales }}</p>
            <p>Purchases: {{ $dailyPurchases }}</p>
            <p>Expenses: {{ $dailyExpenses }}</p>
            <hr class="my-3">
            <p class="font-bold">Profit: {{ $dailyProfit }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">This Month</h2>
            <p>Sales: {{ $monthlySales }}</p>
            <p>Purchases: {{ $monthlyPurchases }}</p>
            <p>Expenses: {{ $monthlyExpenses }}</p>
            <hr class="my-3">
            <p class="font-bold">Profit: {{ $monthlyProfit }}</p>
        </div>

    </div>

@endsection