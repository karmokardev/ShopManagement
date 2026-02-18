@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Purchase History</h1>
        <a href="{{ route('purchases.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + New Purchase
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-200 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Date</th>
                    <th class="p-3">Supplier</th>
                    <th class="p-3">Product</th>
                    <th class="p-3">Qty</th>
                    <th class="p-3">Unit Price</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                    <tr class="border-t text-center">
                        <td class="p-3">{{ $purchase->date }}</td>
                        <td class="p-3">{{ $purchase->supplier->name }}</td>
                        <td class="p-3">{{ $purchase->product->name }}</td>
                        <td class="p-3">{{ $purchase->quantity }}</td>
                        <td class="p-3">{{ $purchase->unit_price }}</td>
                        <td class="p-3">{{ $purchase->total_cost }}</td>
                        <td class="p-3">
                            <form action="{{ route('purchases.destroy', $purchase) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete purchase?')"
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