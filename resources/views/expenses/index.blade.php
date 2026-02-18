@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Expenses</h1>
        <a href="{{ route('expenses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add Expense
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
                    <th class="p-3">Description</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                    <tr class="border-t text-center">
                        <td class="p-3">{{ $expense->date }}</td>
                        <td class="p-3">{{ $expense->description }}</td>
                        <td class="p-3">{{ $expense->amount }}</td>
                        <td class="p-3">
                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete expense?')"
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
        {{ $expenses->links() }}
    </div>

@endsection