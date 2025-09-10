@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Mes ventes</h1>
    <a href="{{ route('sales.create.livewire') }}" class="btn btn-primary mb-3">+ Nouvelle vente</a>


    @livewire('list-sales')
@endsection
