@extends('layouts.app')

@section('content')


    <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-6 font-lobster border-b-2 border-teal-500">Add Expense</h1>
    </div>

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-start items-start">

    <div class="bg-white w-full max-w-xl p-8 rounded-2xl shadow-lg border border-gray-100">

        <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">
            Add New Expense
        </h2>

        <form method="POST" action="{{ route('expenses.store') }}">
            @csrf

            <!-- Title -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Title
                </label>
                <input type="text" name="title"
                    value="{{ old('title') }}"
                    class="w-full px-4 py-2 border rounded-lg
                           focus:ring-2 focus:ring-red-400 focus:outline-none transition
                           @error('title') border-red-500 @else border-gray-300 @enderror"
                    required>

                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
<div class="mb-5 grid md:grid-cols-2 gap-4">

    <!-- Amount -->
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">
            Amount
        </label>
        <input type="number" step="0.01" name="amount"
            value="{{ old('amount') }}"
            class="w-full px-4 py-2 border rounded-lg
                   focus:ring-2 focus:ring-red-400 focus:outline-none transition
                   @error('amount') border-red-500 @else border-gray-300 @enderror"
            required>

        @error('amount')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Date -->
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">
            Date
        </label>
        <input type="date" name="date"
            value="{{ old('date', date('Y-m-d')) }}"
            class="w-full px-4 py-2 border rounded-lg
                   focus:ring-2 focus:ring-red-400 focus:outline-none transition
                   @error('date') border-red-500 @else border-gray-300 @enderror"
            required>

        @error('date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

            <!-- Note -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Note (Optional)
                </label>
                <textarea name="note" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-red-400 focus:outline-none transition">{{ old('note') }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center">

                <a href="{{ route('expenses.index') }}"
                   class="text-gray-500 hover:text-gray-700 transition">
                    ← Back
                </a>

                <button type="submit" class="px-4 bg-gradient-to-r from-teal-500 to-cyan-600
                                               hover:shadow-xl hover:scale-105
                                               text-white font-semibold py-3 rounded-lg
                                               shadow-md transition duration-300">
                Save Expense
            </button>

            </div>

        </form>

    </div>

</div>

@endsection