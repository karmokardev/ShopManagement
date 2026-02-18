<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class AIController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 📊 Last 3 Months Sales
        $month1 = Sale::whereMonth('date', $today->copy()->subMonths(1)->month)->sum('total_amount');
        $month2 = Sale::whereMonth('date', $today->copy()->subMonths(2)->month)->sum('total_amount');
        $month3 = Sale::whereMonth('date', $today->copy()->subMonths(3)->month)->sum('total_amount');

        $averageSales = ($month1 + $month2 + $month3) / 3;

        // 📈 Growth Trend
        $growthRate = 0;
        if ($month3 > 0) {
            $growthRate = (($month1 - $month3) / $month3) * 100;
        }

        $predictedNextMonth = $averageSales + ($averageSales * ($growthRate / 100));

        // 📦 Product Demand Forecast
        $products = Product::all();
        $forecastData = [];

        foreach ($products as $product) {

            $last30DaysSales = SaleItem::where('product_id', $product->id)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
                ->sum('quantity');

            $dailyAvg = $last30DaysSales / 30;
            $nextMonthDemand = round($dailyAvg * 30);

            $restockNeeded = $product->stock_quantity < $nextMonthDemand;

            $forecastData[] = [
                'product' => $product,
                'predicted_demand' => $nextMonthDemand,
                'current_stock' => $product->stock_quantity,
                'restock' => $restockNeeded
            ];
        }

        return view('ai.dashboard', compact(
            'predictedNextMonth',
            'growthRate',
            'forecastData'
        ));
    }
}
