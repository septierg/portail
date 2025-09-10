<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $business = auth()->user()->currentBusiness();

        if (!$business) {
            return redirect()->route('businesses.create')
                ->with('error', 'Vous devez d’abord créer une entreprise.');
        }

        $sales = Sale::with(['items.product'])
            ->where('business_id', $business->id)
            ->latest()
            ->paginate(10);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        Sale::create([
            'business_id' => $request->business_id,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $request->quantity * $request->unit_price,
            'sale_date' => $request->sale_date,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('sales.index')->with('success', 'Vente ajoutée avec succès.');
    }
}
