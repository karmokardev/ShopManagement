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

        Purchase::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'remaining_quantity' => $request->quantity, // lot stock
            'unit_price' => $request->unit_price,
            'total_cost' => $total,
            'date' => $request->date
        ]);

        return redirect()->route('purchases.index')
            ->with('success', 'New Lot Created Successfully');
    }


    public function destroy(Purchase $purchase)
    {
        if ($purchase->remaining_quantity < $purchase->quantity) {
            return redirect()->back()
                ->with('error', 'This lot already has sales. Cannot delete.');
        }

        $purchase->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'Lot Deleted Successfully');
    }
}
