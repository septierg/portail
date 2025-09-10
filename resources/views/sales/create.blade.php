@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Ajouter une vente</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreurs :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <input type="hidden" name="business_id" value="{{ auth()->user()->currentBusiness()->id }}">
        <input type="hidden" name="product_id" id="product_id">
        <input type="hidden" name="product_name" id="product_name">
        <input type="hidden" name="unit_price" id="unit_price">

        <div class="mb-3">
            <label for="product_select" class="form-label">Produit ou Service</label>

            @if ($products->isEmpty())
                <div class="alert alert-warning">
                    Aucun produit ou service disponible.
                    <a href="{{ route('products.create') }}">Ajouter un produit ou service</a> pour commencer.
                </div>
            @else
                <select id="product_select" class="form-select" required>
                    @foreach($products as $product)
                        <option
                            value="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}"
                        >
                            {{ $product->name }} - {{ number_format($product->price, 2) }} €
                        </option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantité</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required min="1" value="{{ old('quantity', 1) }}">
        </div>

        <div class="mb-3">
            <label for="display_price" class="form-label">Prix unitaire (€)</label>
            <input type="text" id="display_price" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="sale_date" class="form-label">Date de la vente</label>
            <input type="date" name="sale_date" id="sale_date" class="form-control" value="{{ old('sale_date', now()->toDateString()) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer la vente</button>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('product_select');
        const priceDisplay = document.getElementById('display_price');
        const hiddenProductId = document.getElementById('product_id');
        const hiddenProductName = document.getElementById('product_name');
        const hiddenUnitPrice = document.getElementById('unit_price');

        function updateHiddenFields() {
            const selected = select.options[select.selectedIndex];
            const price = selected.getAttribute('data-price');
            const name = selected.getAttribute('data-name');
            const id = selected.value;

            hiddenProductId.value = id;
            hiddenProductName.value = name;
            hiddenUnitPrice.value = parseFloat(price).toFixed(2);
            priceDisplay.value = parseFloat(price).toFixed(2);
        }

        select.addEventListener('change', updateHiddenFields);
        updateHiddenFields(); // initial setup
    });
</script>
@endpush
