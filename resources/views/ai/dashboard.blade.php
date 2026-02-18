@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">AI Sales Prediction</h1>

<div class="bg-white p-6 rounded shadow mb-8">
    <h2 class="text-xl font-bold mb-3">Next Month Sales Prediction</h2>

    <p class="text-lg">
        Predicted Sales:
        <span class="font-bold text-green-600">
            {{ number_format($predictedNextMonth, 2) }}
        </span>
    </p>

    <p class="mt-2">
        Growth Trend:
        <span class="font-bold">
            {{ number_format($growthRate, 2) }} %
        </span>
    </p>
</div>

<h2 class="text-2xl font-bold mb-4">Product Demand Forecast</h2>

<div class="bg-white shadow rounded">
<table class="w-full">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Product</th>
            <th class="p-3">Current Stock</th>
            <th class="p-3">Predicted Demand</th>
            <th class="p-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($forecastData as $data)
        <tr class="border-t text-center">
            <td class="p-3">{{ $data['product']->name }}</td>
            <td class="p-3">{{ $data['current_stock'] }}</td>
            <td class="p-3">{{ $data['predicted_demand'] }}</td>
            <td class="p-3">
                @if($data['restock'])
                    <span class="bg-red-500 text-white px-3 py-1 rounded">
                        Restock Recommended
                    </span>
                @else
                    <span class="bg-green-500 text-white px-3 py-1 rounded">
                        Stock OK
                    </span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
