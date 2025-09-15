@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Bienvenue {{ auth()->user()->name }} 👋</h2>

    <div class="card mb-4">
        <div class="card-header">Vos informations</div>
        <div class="card-body">
            <p><strong>Nom :</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email :</strong> {{ auth()->user()->email }}</p>
        </div>
    </div>

    @if ($product && auth()->user()->role === 'user')
    <div class="card mb-4">
        <div class="card-header">Cours auquel vous etes inscrits</div>
        @foreach ($product as $p)
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $p->name }}</p>
            <p><strong>Inscrit le :</strong> {{ $p->created_at->format('d/m/Y') }}</p>
        </div>
        @endforeach
    </div>
    @endif


    @php
        $business = auth()->user()->businesses->first();
    @endphp

    @if ($business)
    <div class="card mb-4">
        <div class="card-header">Votre entreprise</div>
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $business->name }}</p>
            <p><strong>Type :</strong> {{ ucfirst($business->type) }}</p>
            <p><strong>Créée le :</strong> {{ $business->created_at->format('d/m/Y') }}</p>
        </div>
    </div>
    @endif

    {{-- Section visible uniquement aux administrateurs --}}
    @if(auth()->user()->role === 'admin')
    <div class="card">
        <div class="card-header">Actions administratives</div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    📦 Gestion des produits / services
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary float-end">Accéder</a>
                </li>
                <li class="list-group-item">
                    📈 Suivi des ventes
                    <a href="{{ route('sales.index') }}" class="btn btn-sm btn-primary float-end">Accéder</a>
                </li>
                <li class="list-group-item">
                    🧑‍🤝‍🧑 Gestion des utilisateurs
                    <a href="" class="btn btn-sm btn-primary float-end">Accéder</a>
                </li>
                <li class="list-group-item">
                    🏢 Modifier mon entreprise
                    <a href="{{ route('businesses.edit', $business->id) }}" class="btn btn-sm btn-warning float-end">Éditer</a>
                </li>
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection
