@extends('layouts.app')

@section('content')

<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Customers</h1>
    <a href="{{ route('customers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
        + Add Customer
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
            <th class="p-3 text-left">Name</th>
            <th class="p-3">Phone</th>
            <th class="p-3">Address</th>
            <th class="p-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
        <tr class="border-t">
            <td class="p-3">{{ $customer->name }}</td>
            <td class="p-3 text-center">{{ $customer->phone }}</td>
            <td class="p-3 text-center">{{ $customer->address }}</td>
            <td class="p-3 text-center space-x-2">
                <a href="{{ route('customers.edit', $customer) }}" class="bg-yellow-400 px-3 py-1 rounded">Edit</a>
                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Delete?')" class="bg-red-500 text-white px-3 py-1 rounded">
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
    {{ $customers->links() }}
</div>

@endsection
