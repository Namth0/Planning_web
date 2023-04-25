@extends('template/base')

@section('content')

<form method="POST">
    @csrf
    <p>Êtes-vous sûr de vouloir supprimer la séance de cours du {{ $seance->date_debut }} au {{ $seance->date_fin }} ?</p>
    <button type="submit">Supprimer la séance</button>
</form>

@endsection
