@extends('layouts.app')

@section('title', 'Modifier entreprise')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Modifier mon entreprise</h2>

    <form action="{{ route('businesses.update', $business->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom de l'entreprise</label>
            <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name', $business->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" name="type" id="type" class="form-control"
                   value="{{ old('type', $business->type) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (optionnel)</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="{{ old('email', $business->email) }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone (optionnel)</label>
            <input type="text" name="phone" id="phone" class="form-control"
                   value="{{ old('phone', $business->phone) }}">
        </div>

        <button type="submit" class="btn btn-success">💾 Sauvegarder</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
