<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Purchase;
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
        $sale->load([
            'items.product',
            'items.purchase', // 🔥 lot relation
            'customer'
        ]);

        $pdf = Pdf::loadView('sales.invoice', compact('sale'));

        return $pdf->download('invoice-' . $sale->id . '.pdf');
    }


    public function create()
    {
        $lots = Purchase::where('remaining_quantity', '>', 0)
            ->with('product')
            ->get();

        $customers = Customer::all();

        return view('sales.create', compact('lots', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'lots' => 'required|array'
        ]);

        DB::beginTransaction();

        try {

            $totalAmount = 0;

            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'date' => $request->date,
                'total_amount' => 0
            ]);

            foreach ($request->lots as $lotId => $qty) {

                $qty = (int) $qty;
                if ($qty <= 0)
                    continue;

                $purchase = Purchase::findOrFail($lotId);

                // 🔥 STOCK CHECK
                if ($purchase->remaining_quantity <= 0) {
                    throw new \Exception("Lot #{$lotId} stock is 0.");
                }

                if ($qty > $purchase->remaining_quantity) {
                    throw new \Exception("Not enough stock in Lot #{$lotId}");
                }

                $product = $purchase->product;

                $total = $qty * $product->selling_price;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'purchase_id' => $purchase->id,
                    'quantity' => $qty,
                    'unit_price' => $product->selling_price,
                    'total_price' => $total
                ]);

                // Deduct lot stock
                $purchase->decrement('remaining_quantity', $qty);

                $totalAmount += $total;
            }

            if ($totalAmount <= 0) {
                throw new \Exception("No lots selected.");
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

        try {

            // Load items with purchase relation
            $sale->load('items.purchase');

            foreach ($sale->items as $item) {

                if ($item->purchase) {
                    // Restore lot stock
                    $item->purchase->increment('remaining_quantity', $item->quantity);
                }
            }

            // Delete sale items first (optional but clean)
            $sale->items()->delete();

            // Delete sale
            $sale->delete();

            DB::commit();

            return redirect()->route('sales.index')
                ->with('success', 'Sale Deleted & Lot Stock Restored Successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Something went wrong while deleting sale.');
        }
    }


}
