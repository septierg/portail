@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Créer un nouveau cours</h1>

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

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titre du cours</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Niveau</label>
            <select name="level" id="level" class="form-select" required>
                <option value="all level" {{ old('level') == 'all level' ? 'selected' : '' }}>Tous niveaux</option>
                <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>Débutant</option>
                <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>Intermédiaire</option>
                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Avancé</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (facultative)</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Date de début</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                value="{{ old('start_date') ?? now()->toDateString() }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Date de fin</label>
            <input type="date" name="end_date" id="end_date" class="form-control"
                value="{{ old('end_date') ?? now()->addWeek()->toDateString() }}" required>
        </div>

        <button type="submit" class="btn btn-success">Créer le cours</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
