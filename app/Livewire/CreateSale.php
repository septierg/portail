<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateSale extends Component
{
    public $products;
    public $sale_date;
    public $items = [];

    public function mount()
    {
        $this->products = Product::where('business_id', Auth::user()->currentBusiness()->id)->get();
        $this->sale_date = now()->toDateString();

        // Ajoute une ligne par défaut
        $this->addItem();
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
            'product_name' => '',
            'quantity' => 1,
            'unit_price' => 0,
            'total_price' => 0,
        ];

        //dispatchBrowserEvent('scroll-to-new-item');
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Réindexer
    }

    public function updatedItems()
    {
        foreach ($this->items as $index => $item) {
            if (!empty($item['product_id'])) {
                $product = Product::find($item['product_id']);

                if ($product) {
                    $this->items[$index]['product_name'] = $product->name;
                    $this->items[$index]['unit_price'] = $product->price;
                    $this->items[$index]['total_price'] = $product->price * $item['quantity'];
                }
            }
        }
    }

    public function submit()
    {
        $this->items = array_values(array_filter($this->items, function ($item) {
            return !empty($item['product_id']);
        }));


        $this->validate([
            'sale_date' => 'required|date',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $businessId = Auth::user()->currentBusiness()->id;

        $sale = Sale::create([
            'business_id' => $businessId,
            'sale_date' => $this->sale_date,
            'total_price' => collect($this->items)->sum('total_price'),
        ]);

        foreach ($this->items as $item) {
            $product = Product::find($item['product_id']);

            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'total_price' => $product->price * $item['quantity'],
            ]);
        }

        session()->flash('success', 'Vente enregistrée avec succès.');
        return redirect()->route('sales.index');
    }

    public function render()
    {
        return view('livewire.create-sale')->extends('layouts.app')->section('content');
    }
}
