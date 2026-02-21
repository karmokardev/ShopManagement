@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold font-lobster border-b-2 border-teal-500">Sales</h1>
        <a href="{{ route('sales.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded">
            + New Sale
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-200 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class=" overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-max w-full text-sm text-gray-600 whitespace-nowrap">

                <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left">Date</th>
                        <th class="px-6 py-4 text-left">Customer</th>
                        <th class="px-6 py-4 text-left">Product</th>
                        <th class="px-6 py-4 text-center">Lot</th>
                        <th class="px-6 py-4 text-center">Qty</th>
                        <th class="px-6 py-4 text-center">Buying</th>
                        <th class="px-6 py-4 text-center">Selling</th>
                        <th class="px-6 py-4 text-center">Total</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @foreach($sales as $sale)

                        <tr class="hover:bg-gray-50 transition duration-200">

                            <!-- Date -->
                            <td class="px-6 py-4">
                                {{ $sale->sale_date }}
                            </td>

                            <!-- Customer -->
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $sale->customer->name ?? 'Walk-in' }}
                            </td>

                            <!-- Product -->
                            <td class="px-6 py-4">
                                {{ $sale->product->name ?? '-' }}
                            </td>

                            <!-- Lot -->
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-600">
                                    {{ $sale->purchase->lot_no ?? '-' }}
                                </span>
                            </td>

                            <!-- Quantity -->
                            <td class="px-6 py-4 text-center font-semibold">
                                {{ $sale->quantity }}
                            </td>

                            <!-- Buying Price -->
                            <td class="px-6 py-4 text-center text-gray-500">
                                ৳ {{ number_format($sale->buying_price, 2) }}
                            </td>

                            <!-- Selling Price -->
                            <td class="px-6 py-4 text-center">
                                ৳ {{ number_format($sale->selling_price, 2) }}
                            </td>

                            <!-- Total -->
                            <td class="px-6 py-4 text-center font-bold text-green-600">
                                ৳ {{ number_format($sale->total_price, 2) }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-center space-x-2">

                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Delete sale?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                                       bg-red-500 hover:bg-red-600
                                                       text-white rounded-lg shadow-sm transition">
                                        Delete
                                    </button>
                                </form>

                                <a href="{{ route('sales.invoice', $sale->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                              bg-blue-500 hover:bg-blue-600
                                              text-white rounded-lg shadow-sm transition">
                                    📄 PDF
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

    <div class="mt-4">
        {{ $sales->links() }}
    </div>

@endsection