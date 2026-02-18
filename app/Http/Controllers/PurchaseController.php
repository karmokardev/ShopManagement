<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'product'])
            ->latest()
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric',
            'date' => 'required|date'
        ]);

        $total = $request->quantity * $request->unit_price;

        $purchase = Purchase::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_cost' => $total,
            'date' => $request->date
        ]);

        // 🔥 Auto Stock Increase
        $product = Product::find($request->product_id);
        $product->stock_quantity += $request->quantity;
        $product->buying_price = $request->unit_price; // Update latest buying price
        $product->save();

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase Recorded & Stock Updated');
    }

    public function destroy(Purchase $purchase)
    {
        // Reduce stock if purchase deleted
        $product = $purchase->product;
        $product->stock_quantity -= $purchase->quantity;
        $product->save();

        $purchase->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase Deleted');
    }
}
