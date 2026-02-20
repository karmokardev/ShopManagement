<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest()->paginate(10);

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')
            ->with('success', 'Expense Added');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense Deleted');
    }

    // 🔥 Financial Report
    public function report()
    {
        $today = Carbon::today();

        // ===== DAILY =====
        $dailySales = Sale::whereDate('sale_date', $today)
            ->sum('total_price');

        $dailyCOGS = Sale::whereDate('sale_date', $today)
            ->sum(DB::raw('quantity * buying_price'));

        $dailyExpenses = Expense::whereDate('date', $today)
            ->sum('amount');

        $dailyProfit = $dailySales - $dailyCOGS - $dailyExpenses;


        // ===== MONTHLY =====
        $monthlySales = Sale::whereYear('sale_date', $today->year)
            ->whereMonth('sale_date', $today->month)
            ->sum('total_price');

        $monthlyCOGS = Sale::whereYear('sale_date', $today->year)
            ->whereMonth('sale_date', $today->month)
            ->sum(DB::raw('quantity * buying_price'));

        $monthlyExpenses = Expense::whereYear('date', $today->year)
            ->whereMonth('date', $today->month)
            ->sum('amount');

        $monthlyProfit = $monthlySales - $monthlyCOGS - $monthlyExpenses;

        return view('expenses.report', compact(
            'dailySales',
            'dailyCOGS',
            'dailyExpenses',
            'dailyProfit',
            'monthlySales',
            'monthlyCOGS',
            'monthlyExpenses',
            'monthlyProfit'
        ));
    }
}
