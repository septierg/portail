<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Vérifie via la policy
        $this->authorize('viewAny', Product::class);

        // Récupère l'entreprise de l'utilisateur
        $business = auth()->user()->currentBusiness();

        // Cette ligne devient facultative car on a déjà vérifié via la policy,
        // mais tu peux la garder pour charger les données
        $products = Product::where('business_id', $business->id)->get();


        /*$business = auth()->user()->currentBusiness();

        if (!$business) {
            return redirect()->route('businesses.create')
                ->with('error', 'Vous devez d’abord créer une entreprise.');
        }

        $products = Product::where('business_id', $business->id)->get();*/

        return view('products.index', compact('products'));

    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('products.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:produit,service',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:0',
            'start_at' => 'nullable|date',
        ]);

        $business = auth()->user()->businesses->first();

        Product::create([
            'business_id' => $business->id,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'type' => $validated['type'],
            'description' => $validated['description'] ?? null,
            'duration' => $validated['duration'] ?? null,
            'start_at' => $validated['start_at'] ?? null,
            'is_active' => true,
        ]);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        if (!auth()->user()->isAdmin()) {
            abort(403, 'Action réservée aux administrateurs.');
        }
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:produit,service',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:0',
            'start_at' => 'nullable|date',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé.');
    }
}
