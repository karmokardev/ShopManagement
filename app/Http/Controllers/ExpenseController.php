<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date'
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

        $dailySales = Sale::whereDate('date', $today)->sum('total_amount');
        $dailyPurchases = Purchase::whereDate('date', $today)->sum('total_cost');
        $dailyExpenses = Expense::whereDate('date', $today)->sum('amount');

        $dailyProfit = $dailySales - $dailyPurchases - $dailyExpenses;

        $monthlySales = Sale::whereMonth('date', $today->month)->sum('total_amount');
        $monthlyPurchases = Purchase::whereMonth('date', $today->month)->sum('total_cost');
        $monthlyExpenses = Expense::whereMonth('date', $today->month)->sum('amount');

        $monthlyProfit = $monthlySales - $monthlyPurchases - $monthlyExpenses;

        return view('expenses.report', compact(
            'dailySales',
            'dailyPurchases',
            'dailyExpenses',
            'dailyProfit',
            'monthlySales',
            'monthlyPurchases',
            'monthlyExpenses',
            'monthlyProfit'
        ));
    }
}
