@extends('layouts.app')

@section('title', 'Mes produits et services')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Produits et service enregistrés</h2>
        <a href="{{ route('products.create') }}" class="btn btn-success">+ Ajouter un produit ou service</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($products->isEmpty())
        <p>Vous n'avez encore enregistré aucun produit ou service.</p>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix (€)</th>
                <th>Date d'ajout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        {{ $product->name }}<br>
                        @if($product->type === 'service')
                            <a href="{{ route('products.registrations.index', ['product' => $product->id]) }}" class="btn btn-sm btn-primary mt-2">
                                Voir les inscrits
                            </a>
                        @endif
                    </td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                            ✏️ Éditer
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endif
</div>
@endsection
