@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Mes cours</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">+ Nouveau cours</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($courses->isEmpty())
        <div class="alert alert-info">
            Aucun cours disponible pour le moment.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Niveau</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Description</th>
                    <th>Inscriptions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->title }}</td>
                    <td>
                        @switch($course->level)
                            @case('beginner') Débutant @break
                            @case('intermediate') Intermédiaire @break
                            @case('advanced') Avancé @break
                            @default Tous niveaux
                        @endswitch
                    </td>
                    <td>{{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($course->end_date)->format('d/m/Y') }}</td>
                    <td>{{ Str::limit($course->description, 50) }}</td>
                    <td>
                        <span class="badge bg-info">
                            {{ $course->registrations_count }} inscrit{{ $course->registrations_count > 1 ? 's' : '' }}
                        </span>
                        <a href="{{ route('courses.registrations.index', $course) }}" class="badge bg-info text-decoration-none">
                            {{ $course->registrations_count }} inscrit{{ $course->registrations_count > 1 ? 's' : '' }}
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $courses->links() }}
            </div>
        </div>
    @endif
@endsection
