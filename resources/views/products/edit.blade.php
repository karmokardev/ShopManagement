@extends('layouts.app')

@section('content')
    <div class="flex gap-4 mb-4">
        <h1 class="text-2xl font-bold font-lobster border-b-2 border-teal-500">Edit Product</h1>


        <a href="{{ route('products.index') }}" class="bg-teal-500 text-white px-4 py-2 rounded">
            Back to Product List
        </a>
    </div>

    <div class="flex justify-start items-start">

        <form method="POST" action="{{ route('products.update', $product) }}"
            class="bg-white w-full max-w-lg p-8 rounded-2xl shadow-lg border border-gray-100">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">
                Edit Product
            </h2>

            <!-- Name -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Product Name
                </label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-teal-500 focus:outline-none
                                  transition">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Category
                </label>
                <input type="text" name="category" value="{{ old('category', $product->category) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-teal-500 focus:outline-none
                                  transition">
                @error('category')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Units -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Units
                </label>
                <input type="number" step="1" name="units" value="{{ old('units', $product->units) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-teal-500 focus:outline-none
                                  transition">
                @error('units')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Update Button -->
            <div class="flex justify-between items-center">

                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                    ← Back
                </a>

                <button type="submit" class="px-4 bg-gradient-to-r from-teal-500 to-cyan-600
                                                   hover:shadow-xl hover:scale-105
                                                   text-white font-semibold py-3 rounded-lg
                                                   shadow-md transition duration-300">
                    Update Product
                </button>

            </div>

        </form>

    </div>

@endsection