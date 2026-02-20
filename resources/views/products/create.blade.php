@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Add Product</h1>

@if(session('error'))
    <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('products.store') }}" class="bg-white p-6 rounded shadow w-1/2">
    @csrf

    <div class="mb-4">
        <label>Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded"
               value="{{ old('name') }}">
    </div>

    <div class="mb-4">
        <label>Category</label>
        <input type="text" name="category" class="w-full border p-2 rounded"
               value="{{ old('category') }}">
    </div>

    <div class="mb-4">
        <label>Units</label>
        <input type="number" step="1" name="units" placeholder="0"
               class="w-full border p-2 rounded"
               value="{{ old('units') }}">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Save Product
    </button>

</form>

@endsection
