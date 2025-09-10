@extends('layouts.app')

@section('title', 'Créer votre entreprise')

@section('content')
<div class="container mt-5">
    <h1>Bienvenue ! Commençons par créer votre entreprise.</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oups !</strong> Veuillez corriger les erreurs ci-dessous :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('businesses.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom de l'entreprise</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone</label>
            <input type="tel" name="phone" id="phone" class="form-control"
                value="{{ old('phone') }}" required
                pattern="^(\+?\d{1,3}[- ]?)?\d{10}$"
                placeholder="Ex: 0696XXXXXX ou +596696XXXXXX">
            @error('phone')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type d'activité</label>
            <select name="type" id="type" class="form-select" required>
                <option value="">-- Sélectionner un type --</option>
                <option value="boulangerie" {{ old('type') == 'boulangerie' ? 'selected' : '' }}>Boulangerie</option>
                <option value="centre_culturel" {{ old('type') == 'centre_culturel' ? 'selected' : '' }}>Centre Culturel</option>
                <option value="studio_danse" {{ old('type') == 'studio_danse' ? 'selected' : '' }}>Studio de Danse</option>
                <option value="autre" {{ old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </div>


        <button type="submit" class="btn btn-success">Créer mon entreprise</button>
    </form>
</div>
@endsection
