@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Edit Product</h1>

<form method="POST" action="{{ route('products.update', $product) }}" class="bg-white p-6 rounded shadow w-1/2">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Name</label>
        <input type="text" name="name"
               value="{{ $product->name }}"
               class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Category</label>
        <input type="text" name="category"
               value="{{ $product->category }}"
               class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Units</label>
        <input type="number" step="1"
               name="units"
               value="{{ $product->units }}"
               class="w-full border p-2 rounded">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Update Product
    </button>

</form>

@endsection
