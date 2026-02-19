<?php

namespace App\Http\Controllers;   // 🔥 এটা missing ছিল

use App\Models\Sale;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SaleItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ===== BASIC STATS =====
        $totalProducts = Product::count();
        $totalSales = Sale::sum('total_amount') ?? 0;
        $totalExpenses = Expense::sum('amount') ?? 0;

        $totalProfit = $totalSales - $totalExpenses;

        $profitMargin = $totalSales > 0
            ? round(($totalProfit / $totalSales) * 100, 2)
            : 0;

        $totalStock = Purchase::sum('remaining_quantity') ?? 0;

        // ===== LAST 7 DAYS =====
        $dates = [];
        $salesData = [];
        $expenseData = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::today()->subDays($i);
            $dates[] = $date->format('M d');

            $salesData[] = Sale::whereDate('date', $date)
                ->sum('total_amount') ?? 0;

            $expenseData[] = Expense::whereDate('date', $date)
                ->sum('amount') ?? 0;
        }

        // ===== MONTHLY SALES =====
        $monthlyLabels = [];
        $monthlySales = [];

        for ($m = 1; $m <= 12; $m++) {

            $monthName = Carbon::create()->month($m)->format('M');
            $monthlyLabels[] = $monthName;

            $monthlySales[] = Sale::whereYear('date', now()->year)
                ->whereMonth('date', $m)
                ->sum('total_amount') ?? 0;
        }

        // ===== TOP SELLING LOT =====
        $topSellingLot = SaleItem::select(
            'purchase_id',
            DB::raw('SUM(quantity) as total_qty')
        )
            ->groupBy('purchase_id')
            ->orderByDesc('total_qty')
            ->with('purchase.product')
            ->first();

        // ===== MONTHLY REVENUE VS EXPENSE =====
        $monthlyRevenue = [];
        $monthlyExpense = [];

        for ($m = 1; $m <= 12; $m++) {

            $monthlyRevenue[] = Sale::whereYear('date', now()->year)
                ->whereMonth('date', $m)
                ->sum('total_amount') ?? 0;

            $monthlyExpense[] = Expense::whereYear('date', now()->year)
                ->whereMonth('date', $m)
                ->sum('amount') ?? 0;
        }

        return view('dashboard', compact(
            'totalProducts',
            'totalSales',
            'totalExpenses',
            'totalProfit',
            'profitMargin',
            'totalStock',
            'dates',
            'salesData',
            'expenseData',
            'monthlyLabels',
            'monthlySales',
            'topSellingLot',
            'monthlyRevenue',
            'monthlyExpense'
        ));
    }
}
