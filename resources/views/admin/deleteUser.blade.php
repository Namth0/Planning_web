@extends('template/base')

@section('content')
    <h1>Suppression d'un utilisateur</h1>

    <p>Êtes-vous sûr de vouloir supprimer l'utilisateur "{{ $utilisateur->nom }}" ?</p>

    <form method="POST">
        @csrf
        <button type="submit">Supprimer</button>
    </form>
@endsection
