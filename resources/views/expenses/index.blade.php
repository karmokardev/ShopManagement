@extends('layouts.app')

@section('content')

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold font-lobster border-b-2 border-teal-500">Expenses</h1>
        <a href="{{ route('expenses.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded">
            + Add Expense
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

                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Date</th>
                        <th class="px-6 py-4 text-left">Title</th>
                        <th class="px-6 py-4 text-left">Note</th>
                        <th class="px-6 py-4 text-right">Amount</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($expenses as $expense)

                        <tr class="hover:bg-gray-50 transition duration-200">

                            <td class="px-6 py-4 font-medium">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $expense->date->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $expense->title }}
                            </td>

                            <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                                {{ $expense->note ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-right font-semibold text-red-600">
                                ৳ {{ number_format($expense->amount, 2) }}
                            </td>

                            <td class="px-6 py-4 text-center">

                                <form action="{{ route('expenses.destroy', $expense) }}" method="POST"
                                    onsubmit="return confirm('Delete this expense?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                                   bg-red-500 hover:bg-red-600
                                                   text-white rounded-lg shadow-sm transition">
                                        🗑 Delete
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                No expenses found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

                @if($expenses->count())
                    <tfoot class="bg-gray-50 font-semibold border-t">
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-right">
                                Total:
                            </td>
                            <td class="px-6 py-4 text-right text-red-600 text-base">
                                ৳ {{ number_format($expenses->sum('amount'), 2) }}
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                @endif

            </table>
        </div>

    </div>

    <div class="mt-4">
        {{ $expenses->links() }}
    </div>

@endsection