@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Inscriptions pour le cours : {{ $course->title }}</h1>

    <a href="{{ route('courses.index') }}" class="btn btn-secondary mb-3">← Retour aux cours</a>

    @if ($registrations->isEmpty())
        <div class="alert alert-info">Aucune inscription pour ce cours pour le moment.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Âge</th>
                    <th>Date d'inscription</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations as $registration)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $registration->lastname }}</td>
                        <td>{{ $registration->firstname }}</td>
                        <td>{{ $registration->email }}</td>
                        <td>{{ $registration->age }}</td>
                        <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
