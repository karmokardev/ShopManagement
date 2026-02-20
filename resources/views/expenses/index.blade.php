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
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">Note</th>
                    <th class="p-3 text-right">Amount</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($expenses as $expense)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-3">
                            {{ $expense->date->format('d M Y') }}
                        </td>

                        <td class="p-3">
                            {{ $expense->title }}
                        </td>

                        <td class="p-3 text-gray-500">
                            {{ $expense->note ?? '-' }}
                        </td>

                        <td class="p-3 text-right font-semibold text-red-600">
                            ৳ {{ number_format($expense->amount, 2) }}
                        </td>

                        <td class="p-3 text-center">
                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Delete this expense?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">
                            No expenses found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            @if($expenses->count())
                <tfoot class="bg-gray-50 font-semibold">
                    <tr>
                        <td colspan="4" class="p-3 text-right">
                            Total:
                        </td>
                        <td class="p-3 text-right text-red-600">
                            ৳ {{ number_format($expenses->sum('amount'), 2) }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            @endif

        </table>
    </div>

    <div class="mt-4">
        {{ $expenses->links() }}
    </div>

@endsection