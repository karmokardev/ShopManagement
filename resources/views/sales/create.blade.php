@extends('layouts.app')

@section('content')

    <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-6 font-lobster border-b-2 border-teal-500">Add New Sale</h1>
    </div>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex justify-start items-start">

    <form method="POST" action="{{ route('sales.store') }}"
          class="bg-white w-full max-w-2xl p-8 rounded-2xl shadow-lg border border-gray-100">
        @csrf

        <h2 class="text-2xl font-semibold text-gray-700 text-center mb-5">
            Create New Sale
        </h2>

        <!-- Customer + Product -->
        <div class="grid md:grid-cols-2 gap-5 mb-5">

            <!-- Customer -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Customer
                </label>
                <select name="customer_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                    required>
                    <option value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Product -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Product
                </label>
                <select name="product_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                    required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <!-- Purchase Lot -->
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-600 mb-2">
                Purchase Lot
            </label>
            <select name="purchase_id"
                id="purchaseSelect"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg
                       focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                required>
                <option value="">Select Lot</option>
                @foreach($purchases as $purchase)
                    <option value="{{ $purchase->id }}"
                            data-stock="{{ $purchase->remaining_quantity }}"
                            {{ old('purchase_id') == $purchase->id ? 'selected' : '' }}>
                        Lot #{{ $purchase->lot_no ?? $purchase->id }}
                        (Stock: {{ $purchase->remaining_quantity }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quantity + Selling Price -->
        <div class="grid md:grid-cols-2 gap-5 mb-5">

            <!-- Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Quantity
                    <span id="stockInfo" class="text-xs text-gray-400 ml-2"></span>
                </label>
                <input type="number" name="quantity" id="quantityInput"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                    min="1" required>
            </div>

            <!-- Selling Price -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Selling Price
                </label>
                <input type="number" step="0.01" name="selling_price"
                    value="{{ old('selling_price') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                    required>
            </div>

        </div>

        <div class=" grid md:grid-cols-2 gap-5 mb-5">
     <!-- Total Price -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-2">
                Total Price
            </label>
            <input type="number" step="0.01" name="total_price" id="totalPrice"
                class="w-full px-4 py-2 border border-gray-200 bg-gray-100 rounded-lg"
                readonly>
        </div>

        <!-- Sale Date -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-2">
                Sale Date
            </label>
            <input type="date" name="sale_date"
                value="{{ old('sale_date', date('Y-m-d')) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg
                       focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                required>
        </div>

        </div>
        
        <!-- Submit -->
        <div class="flex justify-between items-center">

                <a href="{{ route('sales.index') }}"
                   class="text-gray-500 hover:text-gray-700 transition">
                    ← Back
                </a>

                <button type="submit" class="px-4 bg-gradient-to-r from-teal-500 to-cyan-600
                                               hover:shadow-xl hover:scale-105
                                               text-white font-semibold py-3 rounded-lg
                                               shadow-md transition duration-300">
                Save Sale
            </button>

            </div>

    </form>

</div>

    <script>
        const quantityInput = document.querySelector('input[name="quantity"]');
        const priceInput = document.querySelector('input[name="selling_price"]');
        const totalInput = document.querySelector('input[name="total_price"]');

        function calculateTotal() {
            const qty = parseFloat(quantityInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;
            totalInput.value = qty * price;
        }

        quantityInput.addEventListener('input', calculateTotal);
        priceInput.addEventListener('input', calculateTotal);
    </script>


@endsection