@extends('layouts.app')

@section('content')

    <h1 class="text-2xl font-bold mb-6">Add Expense</h1>

    <form method="POST" action="{{ route('expenses.store') }}" class="bg-white p-6 rounded shadow w-1/2">
        @csrf

        <div class="mb-4">
            <label>Description</label>
            <input type="text" name="description" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Date</label>
            <input type="date" name="date" class="w-full border p-2 rounded">
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Save Expense
        </button>

    </form>

@endsection