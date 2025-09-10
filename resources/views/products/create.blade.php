@extends('layouts.app')

@section('title', 'Ajouter un produit ou un service')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Ajouter un produit ou un service</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        {{-- Type de produit --}}
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select" required>
                <option value="produit" {{ old('type') === 'produit' ? 'selected' : '' }}>Produit physique</option>
                <option value="service" {{ old('type') === 'service' ? 'selected' : '' }}>Service / Cours</option>
            </select>
            @error('type')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nom --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Prix --}}
        <div class="mb-3">
            <label for="price" class="form-label">Prix (€)</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control"
                   value="{{ old('price') }}" required>
            @error('price')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description (visible seulement pour les services) --}}
        <div class="mb-3 service-field d-none">
            <label for="description" class="form-label">Description du service</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Durée (service) --}}
        <div class="mb-3 service-field d-none">
            <label for="duration" class="form-label">Durée (en minutes)</label>
            <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration') }}">
            @error('duration')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Date de début (service) --}}
        <div class="mb-3 service-field d-none">
            <label for="start_at" class="form-label">Date de début</label>
            <input type="datetime-local" name="start_at" id="start_at" class="form-control"
                   value="{{ old('start_at') }}">
            @error('start_at')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>

{{-- JS simple pour basculer les champs selon le type --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const serviceFields = document.querySelectorAll('.service-field');

        function toggleServiceFields() {
            const isService = typeSelect.value === 'service';
            serviceFields.forEach(field => {
                field.classList.toggle('d-none', !isService);
            });
        }

        typeSelect.addEventListener('change', toggleServiceFields);
        toggleServiceFields(); // Initialiser à l'ouverture
    });
</script>
@endpush
@endsection
