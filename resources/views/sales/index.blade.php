@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Sales</h1>
        <a href="{{ route('sales.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
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

    <div class="bg-white shadow rounded">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Date</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Product</th>
                    <th class="p-3">Lot</th>
                    <th class="p-3">Qty</th>
                    <th class="p-3">Unit Price</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($sales as $sale)
                    <tr class="border-t text-center">

                        <td class="p-3">
                            {{ $sale->sale_date }}
                        </td>

                        <td class="p-3">
                            {{ $sale->customer->name ?? 'Walk-in' }}
                        </td>

                        <td class="p-3">
                            {{ $sale->product->name ?? '-' }}
                        </td>

                        <td class="p-3">
                            {{ $sale->purchase->lot_no ?? '-' }}
                        </td>

                        <td class="p-3">
                            {{ $sale->quantity }}
                        </td>

                        <td class="p-3">
                            {{ number_format($sale->selling_price, 2) }}
                        </td>

                        <td class="p-3 font-bold">
                            {{ number_format($sale->total_price, 2) }}
                        </td>

                        <td class="p-3 flex gap-2 justify-center">
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete sale?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>

                            <a href="{{ route('sales.invoice', $sale->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">
                                PDF
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $sales->links() }}
    </div>

@endsection