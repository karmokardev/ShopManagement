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
        $sales = Sale::with('customer', 'product', 'purchase')
            ->orderBy('sale_date', 'desc')
            ->paginate(10);
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
        $customers = Customer::all();
        $products = Product::all();
        $purchases = Purchase::where('quantity', '>', 0)->get();

        return view('sales.create', compact('customers', 'products', 'purchases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'product_id' => 'required',
            'purchase_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'selling_price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        $purchase = Purchase::findOrFail($request->purchase_id);


        if ($purchase->product_id != $request->product_id) {
            return back()->with('error', 'Invalid product selected for this lot.');
        }

        if ($request->quantity > $purchase->quantity) {
            return back()->with('error', 'Stock not available! Available stock: ' . $purchase->quantity);
        }

        $buyingPrice = $purchase->buying_price;
        $totalPrice = $request->quantity * $request->selling_price;

        $product = Product::findOrFail($request->product_id);
        $customer = Customer::findOrFail($request->customer_id);

        if ($purchase->remaining_quantity < $request->quantity) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['quantity' => 'Not enough stock in the selected lot.']);
        }


        Sale::create([
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'purchase_id' => $purchase->id,
            'quantity' => $request->quantity,
            'buying_price' => $buyingPrice,
            'selling_price' => $request->selling_price,
            'total_price' => $totalPrice,
            'sale_date' => $request->sale_date,
        ]);

        // reduce lot stock
        $purchase->quantity -= $request->quantity;
        $purchase->save();

        return redirect()->route('sales.index')
            ->with('success', 'Sale Created Successfully');
    }





    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {

            $purchase = Purchase::find($sale->purchase_id);

            if ($purchase) {
                $purchase->quantity += $sale->quantity;
                $purchase->save();
            }

            $sale->delete();
        });

        return redirect()->route('sales.index')
            ->with('success', 'Sale deleted and stock restored successfully!');
    }


}
