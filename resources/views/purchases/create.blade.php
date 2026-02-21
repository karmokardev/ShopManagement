@extends('layouts.app')

@section('content')

    <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-6 font-lobster border-b-2 border-teal-500">Add New Lot</h1>
    </div>

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-start items-start">

        <form method="POST" action="{{ route('purchases.store') }}"
            class="bg-white w-full max-w-2xl p-8 rounded-2xl shadow-lg border border-gray-100">
            @csrf

            <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">
                Create New Purchase (Lot)
            </h2>
            <div class="grid md:grid-cols-2 gap-4 mb-5">
                <!-- Supplier -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Supplier
                    </label>
                    <select name="supplier_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                                       focus:ring-2 focus:ring-teal-500 focus:outline-none transition">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Product -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Product
                    </label>
                    <select name="product_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                                       focus:ring-2 focus:ring-teal-500 focus:outline-none transition">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Lot + Quantity -->
            <div class="mb-5 grid md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Lot No
                    </label>
                    <input type="text" name="lot_no" value="{{ old('lot_no') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                                           focus:ring-2 focus:ring-teal-500 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Quantity
                    </label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                                           focus:ring-2 focus:ring-teal-500 focus:outline-none transition">
                </div>

            </div>
            <div class="grid md:grid-cols-2 gap-4 mb-5">
                <!-- Buying Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Buying Price
                    </label>
                    <input type="number" step="0.01" name="buying_price" value="{{ old('buying_price') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                                       focus:ring-2 focus:ring-teal-500 focus:outline-none transition">
                </div>

                <!-- Purchase Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Purchase Date
                    </label>
                    <input type="date" name="purchase_date" value="{{ old('purchase_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                                       focus:ring-2 focus:ring-teal-500 focus:outline-none transition">
                </div>
            </div>


            <!-- Submit Button -->

            <div class="flex justify-between items-center">

                <a href="{{ route('purchases.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                    ← Back
                </a>

                <button type="submit" class="px-4 bg-gradient-to-r from-teal-500 to-cyan-600
                                                   hover:shadow-xl hover:scale-105
                                                   text-white font-semibold py-3 rounded-lg
                                                   shadow-md transition duration-300">
                    Save Purchase (Create Lot)
                </button>

            </div>

        </form>

    </div>

@endsection