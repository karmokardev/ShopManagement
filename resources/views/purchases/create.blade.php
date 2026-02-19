@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">New Purchase (New Lot)</h1>

@if($errors->any())
    <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('purchases.store') }}" class="bg-white p-6 rounded shadow w-1/2">
    @csrf

    <div class="mb-4">
        <label>Supplier</label>
        <select name="supplier_id" class="w-full border p-2 rounded">
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label>Product</label>
        <select name="product_id" class="w-full border p-2 rounded">
            @foreach($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label>Quantity</label>
        <input type="number" name="quantity"
               value="{{ old('quantity') }}"
               class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Unit Price</label>
        <input type="number" step="0.01" name="unit_price"
               value="{{ old('unit_price') }}"
               class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Date</label>
        <input type="date" name="date"
               value="{{ old('date') }}"
               class="w-full border p-2 rounded">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Save Purchase (Create Lot)
    </button>

</form>

@endsection
