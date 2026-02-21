@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold font-lobster border-b-2 border-teal-500">Purchase History</h1>
        <a href="{{ route('purchases.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded">
            + New Lot
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
                        <th class="px-6 py-4 text-left">Supplier</th>
                        <th class="px-6 py-4 text-left">Product</th>
                        <th class="px-6 py-4 text-center">Purchased</th>
                        <th class="px-6 py-4 text-center">Remaining</th>
                        <th class="px-6 py-4 text-center">Unit Price</th>
                        <th class="px-6 py-4 text-center">Total</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @foreach($purchases as $purchase)

                        <tr class="hover:bg-gray-50 transition duration-200">

                            <td class="px-6 py-4">
                                {{ $purchase->purchase_date }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $purchase->supplier->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $purchase->product->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $purchase->quantity }}
                            </td>

                            <!-- Remaining -->
                            <td class="px-6 py-4 text-center">
                                @if($purchase->remaining_quantity <= 0)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">
                                        0 (Sold Out)
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-600">
                                        {{ $purchase->remaining_quantity }}
                                    </span>
                                @endif
                            </td>

                            <!-- Unit Price -->
                            <td class="px-6 py-4 text-center">
                                ৳ {{ number_format($purchase->buying_price, 2) }}
                            </td>

                            <!-- Total -->
                            <td class="px-6 py-4 text-center font-semibold text-gray-800">
                                ৳ {{ number_format($purchase->total_price, 2) }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                @if($purchase->remaining_quantity == $purchase->quantity)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
                                        Full Stock
                                    </span>
                                @elseif($purchase->remaining_quantity == 0)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">
                                        Out
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-500">
                                        Partial
                                    </span>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this lot?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                                       bg-red-500 hover:bg-red-600
                                                       text-white rounded-lg shadow-sm transition">
                                        Delete
                                    </button>
                                </form>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

    <div class="mt-4">
        {{ $purchases->links() }}
    </div>

@endsection