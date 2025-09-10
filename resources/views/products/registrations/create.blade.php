@extends('layouts.app')

@section('content')
    <h1 class="mb-4">{{ $product->business->name }}</h1>

    <h2 class="mb-4">Inscriptions pour le cours : {{ $product->name }}</h2>

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

    <form method="POST" action="{{ route('products.registrations.store', ['product' => $product->id]) }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Prenom</label>
            <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Age</label>
            <input type="numeric" name="age" id="age" class="form-control" value="{{ old('age') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmation du mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-success">S'enregistrer au cours {{ $product->name }}</button>
    </form>

    <hr>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Retour sur la liste de cours du {{ $product->business->name }}</a>

@endsection
