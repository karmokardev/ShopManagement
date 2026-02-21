@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto px-6 py-8">

        <h1 class="text-3xl font-bold text-gray-700 mb-8">
            Financial Report
        </h1>

        <!-- Today Section -->
        <div class="mb-10">

            <h2 class="text-lg font-semibold text-gray-600 mb-4">
                Today
            </h2>

            <div class="grid md:grid-cols-4 gap-6">

                <!-- Sales -->
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <p class="text-sm text-gray-500">Sales</p>
                    <h3 class="text-xl font-bold text-green-600 mt-2">
                        ৳ {{ number_format($dailySales, 2) }}
                    </h3>
                </div>

                <!-- COGS -->
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <p class="text-sm text-gray-500">COGS</p>
                    <h3 class="text-xl font-bold text-orange-500 mt-2">
                        ৳ {{ number_format($dailyCOGS, 2) }}
                    </h3>
                </div>

                <!-- Expenses -->
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <p class="text-sm text-gray-500">Expenses</p>
                    <h3 class="text-xl font-bold text-red-500 mt-2">
                        ৳ {{ number_format($dailyExpenses, 2) }}
                    </h3>
                </div>

                <!-- Profit -->
                <div class="bg-gradient-to-r from-teal-500 to-teal-700 
                                text-white p-6 rounded-2xl shadow-lg">
                    <p class="text-sm opacity-80">Profit</p>
                    <h3 class="text-2xl font-bold mt-2">
                        ৳ {{ number_format($dailyProfit, 2) }}
                    </h3>
                </div>

            </div>

        </div>

        <!-- Monthly Section -->
        <div>

            <h2 class="text-lg font-semibold text-gray-600 mb-4">
                This Month
            </h2>

            <div class="grid md:grid-cols-4 gap-6">

                <!-- Sales -->
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <p class="text-sm text-gray-500">Sales</p>
                    <h3 class="text-xl font-bold text-green-600 mt-2">
                        ৳ {{ number_format($monthlySales, 2) }}
                    </h3>
                </div>

                <!-- COGS -->
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <p class="text-sm text-gray-500">COGS</p>
                    <h3 class="text-xl font-bold text-orange-500 mt-2">
                        ৳ {{ number_format($monthlyCOGS, 2) }}
                    </h3>
                </div>

                <!-- Expenses -->
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <p class="text-sm text-gray-500">Expenses</p>
                    <h3 class="text-xl font-bold text-red-500 mt-2">
                        ৳ {{ number_format($monthlyExpenses, 2) }}
                    </h3>
                </div>

                <!-- Profit -->
                <div class="bg-gradient-to-r from-teal-500 to-teal-700 
                                text-white p-6 rounded-2xl shadow-lg">
                    <p class="text-sm opacity-80">Profit</p>
                    <h3 class="text-2xl font-bold mt-2">
                        ৳ {{ number_format($monthlyProfit, 2) }}
                    </h3>
                </div>

            </div>

        </div>

    </div>

@endsection