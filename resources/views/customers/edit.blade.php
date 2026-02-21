@extends('layouts.app')

@section('content')

    <div class="flex justify-between">
        <h1 class="text-2xl font-bold font-lobster border-b-2 border-teal-500 mb-6">Edit Customer</h1>
    </div>

    <div class="flex justify-start items-start">

        <form method="POST" action="{{ route('customers.update', $customer) }}"
            class="bg-white w-full max-w-lg p-8 rounded-2xl shadow-lg border border-gray-100">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">
                Edit Customer
            </h2>

            <!-- Name -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Customer Name
                </label>
                <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                              focus:ring-2 focus:ring-green-500 focus:outline-none transition">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Phone Number
                </label>
                <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                              focus:ring-2 focus:ring-green-500 focus:outline-none transition">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Address
                </label>
                <textarea name="address" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                 focus:ring-2 focus:ring-green-500 focus:outline-none transition">{{ old('address', $customer->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Update Button -->
            <div class="flex justify-between items-center">

                <a href="{{ route('customers.index') }}"
                   class="text-gray-500 hover:text-gray-700 transition">
                    ← Back
                </a>

                <button type="submit" class="px-4 bg-gradient-to-r from-teal-500 to-cyan-600
                                               hover:shadow-xl hover:scale-105
                                               text-white font-semibold py-3 rounded-lg
                                               shadow-md transition duration-300">
                Update Customer
            </button>

            </div>

        </form>

    </div>

@endsection