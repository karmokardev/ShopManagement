@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold font-lobster border-b-2 border-teal-500">Customers</h1>
        <a href="{{ route('customers.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded">
            + Add Customer
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-200 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class=" overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-max w-full text-sm text-gray-600 whitespace-nowrap">

                <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left">Name</th>
                        <th class="px-6 py-4 text-center">Phone</th>
                        <th class="px-6 py-4 text-center">Address</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @foreach($customers as $customer)

                        <tr class="hover:bg-gray-50 transition duration-200">

                            <!-- Name -->
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $customer->name }}
                            </td>

                            <!-- Phone -->
                            <td class="px-6 py-4 text-center">
                                {{ $customer->phone }}
                            </td>

                            <!-- Address -->
                            <td class="px-6 py-4 text-center max-w-xs truncate">
                                {{ $customer->address }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-center space-x-2">

                                <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                              bg-yellow-400 hover:bg-yellow-500
                                              text-white rounded-lg shadow-sm transition">
                                    ✏ Edit
                                </a>

                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Delete customer?')">
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
        {{ $customers->links() }}
    </div>

@endsection