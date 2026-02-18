<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SaleItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer')->latest()->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function invoice(Sale $sale)
    {
        $sale->load('items.product', 'customer');

        $pdf = Pdf::loadView('sales.invoice', compact('sale'));

        return $pdf->download('invoice-' . $sale->id . '.pdf');
    }

    public function create()
    {
        $products = Product::where('stock_quantity', '>', 0)->get();
        $customers = Customer::all();

        return view('sales.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'products' => 'required|array'
        ]);

        DB::beginTransaction();

        try {

            $totalAmount = 0;

            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'date' => $request->date,
                'total_amount' => 0
            ]);

            foreach ($request->products as $productId => $qty) {

                $qty = (int) $qty;

                if ($qty <= 0)
                    continue;

                $product = Product::find($productId);

                if (!$product) {
                    throw new \Exception("Invalid product selected.");
                }

                // 🔥 STOCK VALIDATION
                if ($qty > $product->stock_quantity) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                $total = $qty * $product->selling_price;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'unit_price' => $product->selling_price,
                    'total_price' => $total
                ]);

                // 🔥 Deduct Stock
                $product->decrement('stock_quantity', $qty);

                $totalAmount += $total;
            }

            if ($totalAmount <= 0) {
                throw new \Exception("No products selected.");
            }

            $sale->update(['total_amount' => $totalAmount]);

            DB::commit();

            return redirect()->route('sales.index')
                ->with('success', 'Sale Completed Successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }


    public function destroy(Sale $sale)
    {
        DB::beginTransaction();

        foreach ($sale->items as $item) {
            $product = $item->product;
            $product->stock_quantity += $item->quantity; // Restore stock
            $product->save();
        }

        $sale->delete();

        DB::commit();

        return redirect()->route('sales.index')
            ->with('success', 'Sale Deleted & Stock Restored');
    }
}
