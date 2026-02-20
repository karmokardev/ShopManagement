@extends('layouts.app')

@section('content')

    <div class="max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">Add Expense</h1>

        <div class="bg-white p-6 rounded shadow">

            <form method="POST" action="{{ route('expenses.store') }}">
                @csrf

                {{-- Title --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border p-2 rounded @error('title') border-red-500 @enderror" required>

                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Amount --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Amount</label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount') }}"
                        class="w-full border p-2 rounded @error('amount') border-red-500 @enderror" required>

                    @error('amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Date</label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                        class="w-full border p-2 rounded @error('date') border-red-500 @enderror" required>

                    @error('date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Note --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Note (Optional)</label>
                    <textarea name="note" class="w-full border p-2 rounded" rows="3">{{ old('note') }}</textarea>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('expenses.index') }}" class="text-gray-600 hover:underline">
                        Back
                    </a>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded">
                        Save Expense
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection