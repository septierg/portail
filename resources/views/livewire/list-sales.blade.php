<div>
    <div class="d-flex flex-wrap gap-3 mb-4 align-items-end">
        <div>

            <label for="fromDate" class="form-label">Du</label>
            <input type="date" id="fromDate" wire:model="fromDate" class="form-control">

        </div>
        <div>
            {{-- toDate: déclenche à la sortie du champ --}}
            <label for="toDate" class="form-label">Au</label>
            <input type="date" wire:model.lazy="toDate" class="form-control">

        </div>
        <div>

        </div>
    </div>

    @if ($sales->isEmpty())
        <div class="alert alert-info">Aucune vente trouvée pour cette période.</div>
    @else
        <div class="mb-3">
            <span class="badge bg-success fs-6">
                Total : {{ number_format($totalAmount, 2, ',', ' ') }} €
            </span>
            <span class="badge bg-primary fs-6">
                {{ $salesCount }} vente{{ $salesCount > 1 ? 's' : '' }} trouvée{{ $salesCount > 1 ? 's' : '' }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Produits</th>
                        <th>Date</th>
                        <th>Total (€)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($sale->items as $item)
                                        <li>
                                            {{ $item->product->name ?? 'Produit supprimé' }} –
                                            {{ $item->quantity }} ×
                                            {{ number_format($item->unit_price, 2, ',', ' ') }} €
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}</td>
                            <td>{{ number_format($sale->total_price, 2, ',', ' ') }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">{{ $sales->links() }}</div>
        </div>
    @endif
</div>
