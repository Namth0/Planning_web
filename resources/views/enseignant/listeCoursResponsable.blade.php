@extends('template/base')

@section('content')

<h1>Liste des cours dont vous êtes responsable</h1>

<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Intitulé</th>
            <th>Formation</th>
            <th>Nombre d'étudiants/Enseignants inscrits</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cours as $c)
        <tr>
            <td>{{ $c->intitule }}</td>
            <td>{{ $c->formation->intitule }}</td>
            <td>{{ $c->etudiants()->count() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
