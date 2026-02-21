@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold font-lobster border-b-2 border-teal-500">Product list</h1>


        <a href="{{ route('products.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded">
            + Add Product
        </a>
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

    <!-- <form method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Search product..." class="border p-2 rounded w-1/3"
            value="{{ request('search') }}">
    </form> -->

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-gray-600">

            <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-center">Category</th>
                    <th class="px-6 py-4 text-center">Unit</th>
                    <th class="px-6 py-4 text-center">Stock</th>
                    <th class="px-6 py-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @foreach($products as $product)

                    @php
                        $totalStock = $product->purchases->sum('remaining_quantity');
                    @endphp

                    <tr class="hover:bg-gray-50 transition duration-200">

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $product->name }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $product->category }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $product->unit }}
                        </td>

                        <!-- Stock Badge -->
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $totalStock > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $totalStock }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-center space-x-2">

                            <a href="{{ route('products.edit', $product) }}"
                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                      bg-yellow-400 hover:bg-yellow-500
                                      text-white rounded-lg shadow-sm transition">
                                ✏ Edit
                            </a>

                            <form action="{{ route('products.destroy', $product) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this product?')"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium
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

    <div class="mt-4">
        {{ $products->links() }}
    </div>

@endsection