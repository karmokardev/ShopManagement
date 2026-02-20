@extends('layouts.app')

@section('content')

    <h1 class="text-2xl font-bold mb-6">New Sale</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('sales.store') }}" class="bg-white p-6 rounded shadow w-1/2 space-y-4">
        @csrf

        {{-- Customer --}}
        <div>
            <label class="block mb-1 font-medium">Customer</label>
            <select name="customer_id" class="w-full border rounded p-2" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Product --}}
        <div>
            <label class="block mb-1 font-medium">Product</label>
            <select name="product_id" class="w-full border rounded p-2" required>
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Purchase Lot --}}
        <div>
            <label class="block mb-1 font-medium">Purchase Lot</label>
            <select name="purchase_id"
                    id="purchaseSelect"
                    class="w-full border rounded p-2"
                    required>
                <option value="">Select Lot</option>
                @foreach($purchases as $purchase)
                    <option value="{{ $purchase->id }}"
                            data-stock="{{ $purchase->remaining_quantity }}"
                            {{ old('purchase_id') == $purchase->id ? 'selected' : '' }}>
                        Lot #{{ $purchase->id }}
                        (Stock: {{ $purchase->remaining_quantity }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Quantity --}}
        <div>
            <label class="block mb-1 font-medium">
                Quantity
                <span id="stockInfo" class="text-sm text-gray-500"></span>
            </label>

            <input type="number" name="quantity" id="quantityInput" class="w-full border rounded p-2" min="1" required>
        </div>

        {{-- Selling Price --}}
        <div>
            <label class="block mb-1 font-medium">Selling Price</label>
            <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price') }}" class="w-full border rounded p-2" required>
        </div>

        {{-- Total Price --}}
        <div>
            <label class="block mb-1 font-medium">Total Price</label>
            <input type="number" step="0.01" name="total_price" id="totalPrice" class="w-full border rounded p-2" readonly>
        </div>

        {{-- Sale Date --}}
        <div>
            <label class="block mb-1 font-medium">Sale Date</label>
            <input type="date" name="sale_date" value="{{ old('sale_date', date('Y-m-d')) }}"
                class="w-full border rounded p-2" required>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Sale
            </button>
        </div>
    </form>

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