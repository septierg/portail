@extends('layouts.app')

@section('title', 'Modifier le produit')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Modifier le produit ou le service</h2>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Type --}}
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select" required>
                <option value="produit" {{ $product->type === 'produit' ? 'selected' : '' }}>Produit physique</option>
                <option value="service" {{ $product->type === 'service' ? 'selected' : '' }}>Service / Cours</option>
            </select>
            @error('type')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nom --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Prix --}}
        <div class="mb-3">
            <label for="price" class="form-label">Prix (€)</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control"
                   value="{{ old('price', $product->price) }}" required>
            @error('price')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3 service-field">
            <label for="description" class="form-label">Description du service</label>
            <textarea name="description" id="description" class="form-control"
                      rows="3">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Durée --}}
        <div class="mb-3 service-field">
            <label for="duration" class="form-label">Durée (en minutes)</label>
            <input type="number" name="duration" id="duration" class="form-control"
                   value="{{ old('duration', $product->duration) }}">
            @error('duration')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Date de début --}}
        <div class="mb-3 service-field">
            <label for="start_at" class="form-label">Date de début</label>
            <input type="datetime-local" name="start_at" id="start_at" class="form-control"
                   value="{{ old('start_at', optional($product->start_at)->format('Y-m-d\TH:i')) }}">
            @error('start_at')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

{{-- JS pour afficher/masquer les champs des services --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const serviceFields = document.querySelectorAll('.service-field');

        function toggleFields() {
            const isService = typeSelect.value === 'service';
            serviceFields.forEach(field => {
                field.classList.toggle('d-none', !isService);
            });
        }

        typeSelect.addEventListener('change', toggleFields);
        toggleFields(); // initialisation
    });
</script>
@endpush
@endsection
