<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with('purchases') // 🔥 important
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'unit' => 'required|string|max:255',
        ]);

        

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'unit' => $request->unit,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product Added Successfully');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }
}
