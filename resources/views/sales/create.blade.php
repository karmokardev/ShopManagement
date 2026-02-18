@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Create Sale</h1>

<form method="POST" action="{{ route('sales.store') }}" class="bg-white p-6 rounded shadow">
    @csrf

    <div class="mb-4">
        <label>Date</label>
        <input type="date" name="date" class="border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Customer</label>
        <select name="customer_id" class="border p-2 rounded">
            <option value="">Walk-in</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>

    <h2 class="text-lg font-bold mt-6 mb-3">Products</h2>

    @foreach($products as $product)
    <div class="flex items-center space-x-4 mb-2">
        <span class="w-1/4">
            {{ $product->name }} (Stock: {{ $product->stock_quantity }})
        </span>
        <input type="number"
               name="products[{{ $product->id }}]"
               placeholder="Quantity"
               class="border p-2 rounded w-32">
    </div>
    @endforeach

    <button class="bg-green-600 text-white px-4 py-2 rounded mt-4">
        Complete Sale
    </button>

</form>

@endsection
