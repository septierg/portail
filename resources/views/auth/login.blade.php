@extends('layouts.app')

@section('content')

    <h1>Connexion</h1>
    <form method="POST" action="{{ url('login') }}">
        @csrf

        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            <label for="email" class="form-label">Adresse e-mail</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" required>
            <label for="password" class="form-label">Mot de passe</label>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>

    </form>

@endsection

