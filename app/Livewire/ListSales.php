<?php

namespace App\Livewire;

use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListSales extends Component
{
    use WithPagination;

    public $fromDate;
    public $toDate;
    public $totalAmount = 0;
    public $salesCount = 0;



    protected $updatesQueryString = ['fromDate', 'toDate'];


    public function render()
    {
        $query = Sale::with(['items.product'])
            ->where('business_id', Auth::user()->currentBusiness()->id);

        if ($this->fromDate) {
            $query->whereDate('sale_date', '>=', $this->fromDate);
        }

        if ($this->toDate) {
            $query->whereDate('sale_date', '<=', $this->toDate);
        }

        $sales = $query->latest()->paginate(10);

        // Calcul du total et du nombre de ventes
        $this->totalAmount = $query->sum('total_price');
        $this->salesCount = $query->count();

        return view('livewire.list-sales', compact('sales'));
    }
}
