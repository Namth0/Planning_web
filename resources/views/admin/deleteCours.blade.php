@extends('template/base')

@section('content')

<form method="POST">
    @csrf
    <p>Êtes-vous sûr de vouloir supprimer le cours {{$cours->intitule}}</p>
    <button type="submit">Supprimer la séance</button>
</form>

@endsection