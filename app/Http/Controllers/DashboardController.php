<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Expense;
use App\Models\Product;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSales = Sale::sum('total_amount');
        $totalExpenses = Expense::sum('amount');
        $totalProfit = $totalSales - $totalExpenses;

        // Last 7 Days Data
        $dates = [];
        $salesData = [];
        $expenseData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dates[] = $date->format('M d');

            $salesData[] = Sale::whereDate('date', $date)->sum('total_amount');
            $expenseData[] = Expense::whereDate('date', $date)->sum('amount');
        }

        return view('dashboard', compact(
            'totalProducts',
            'totalSales',
            'totalExpenses',
            'totalProfit',
            'dates',
            'salesData',
            'expenseData'
        ));
    }
}
