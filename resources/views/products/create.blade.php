@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Add Product</h1>

<form method="POST" action="{{ route('products.store') }}" class="bg-white p-6 rounded shadow w-1/2">
    @csrf

    <div class="mb-4">
        <label>Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Category</label>
        <input type="text" name="category" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Buying Price</label>
        <input type="number" step="0.01" name="buying_price" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Selling Price</label>
        <input type="number" step="0.01" name="selling_price" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Stock Quantity</label>
        <input type="number" name="stock_quantity" class="w-full border p-2 rounded">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Save Product
    </button>

</form>

@endsection
