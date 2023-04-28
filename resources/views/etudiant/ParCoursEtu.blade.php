@extends('template/base')

@section('content')

<h1>Liste des cours par Cours</h1>
<form action="/perCoursEtu" method="GET">
@csrf
    <input type="text" name="search" placeholder="Rechercher par intitule">
    <button type="submit">Rechercher</button>
</form>

<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Cours Inscrit</th>
            <th>Nombre d'étudiants/Enseignants inscrits</th>
             <th>Debut des cours</th>
            <th>Fin des cours</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cours as $c)
        <tr>
            <td>{{ $c->intitule }}</td>
            <td>{{ $c->etudiants()->count() }}</td>
            @if($c->plannings->count() > 0)
                @foreach($c->plannings as $planning)
                    <td>{{ $planning->date_debut }}</td>
                    <td>{{ $planning->date_fin }}</td>
                @endforeach
            @else
                <td>no date</td>
                <td>no date</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

@endsection