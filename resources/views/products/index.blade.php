@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Product</h1>

        @if($products->count() == 0)
            <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                + Add Product
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Search product..." class="border p-2 rounded w-1/3"
            value="{{ request('search') }}">
    </form>

    <div class="bg-white shadow rounded">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-center">Category</th>
                    <th class="p-3 text-center">Selling Price</th>
                    <th class="p-3 text-center">Total Stock</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)

                    @php
                        $totalStock = $product->purchases->sum('remaining_quantity');
                    @endphp

                    <tr class="border-t">
                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3 text-center">{{ $product->category }}</td>
                        <td class="p-3 text-center">{{ $product->selling_price }}</td>

                        <td class="p-3 text-center">
                            @if($totalStock <= 0)
                                <span class="text-red-600 font-bold">
                                    0 (Out of Stock!)
                                </span>
                            @elseif($totalStock < 5)
                                <span class="text-orange-600 font-bold">
                                    {{ $totalStock }} (Low!)
                                </span>
                            @else
                                {{ $totalStock }}
                            @endif
                        </td>

                        <td class="p-3 text-center space-x-2">
                            <a href="{{ route('products.edit', $product) }}" class="bg-yellow-400 px-3 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this product?')"
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
        {{ $products->links() }}
    </div>

@endsection