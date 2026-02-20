@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Lot History</h1>
        <a href="{{ route('purchases.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
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

    <div class="bg-white shadow rounded">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Date</th>
                    <th class="p-3">Supplier</th>
                    <th class="p-3">Product</th>
                    <th class="p-3">Purchased Qty</th>
                    <th class="p-3">Remaining</th>
                    <th class="p-3">Unit Price</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($purchases as $purchase)

                    <tr class="border-t text-center">
                        <td class="p-3">{{ $purchase->purchase_date }}</td>

                        <td class="p-3">{{ $purchase->supplier->name ?? '-' }}</td>

                        <td class="p-3">{{ $purchase->product->name ?? '-' }}</td>

                        <td class="p-3">{{ $purchase->quantity }}</td>

                        <td class="p-3">
                            @if($purchase->remaining_quantity <= 0)
                                <span class="text-red-600 font-bold">
                                    0 (Sold Out)
                                </span>
                            @else
                                {{ $purchase->remaining_quantity }}
                            @endif
                        </td>

                        <td class="p-3">{{ number_format($purchase->buying_price, 2) }}</td>

                        <td class="p-3">{{ number_format($purchase->total_price, 2) }}</td>

                        <td class="p-3">
                            @if($purchase->remaining_quantity == $purchase->quantity)
                                <span class="text-green-600 font-bold">Full Stock</span>
                            @elseif($purchase->remaining_quantity == 0)
                                <span class="text-red-600 font-bold">Out</span>
                            @else
                                <span class="text-orange-500 font-bold">Partial</span>
                            @endif
                        </td>

                        <td class="p-3">
                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete this lot?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $purchases->links() }}
    </div>

@endsection