@extends('template/base')

@section('content')
    <h2>Voici les cours des enseignants</h2>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>Enseignant</th>
                <th>Cours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enseignants as $enseignant)
                <tr>
                    <td>{{ $enseignant->nom }}</td>
                    <td>
                        <ul>
                            @foreach ($enseignant->cours as $coursEnseignant)
                                <li>{{ $coursEnseignant->intitule }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="/gerer" method="GET">
        @csrf
        <input type="text" name="search" placeholder="Rechercher par intitulé">
        <button type="submit">Rechercher</button>
    </form>

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Intitulé</th>
                <th>Formation</th>
                <th>Nombre d'étudiants/Enseignants inscrits</th>
                <th>Creer une seance</th>
                <th>Modifier une seance</th>
                <th>Supprimer une seance</th>
                <th>Date début</th>
                <th>Date fin</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($cours as $cours)
                <tr>
                    <td>{{ $cours->id }}</td>
                    <td>{{ $cours->intitule }}</td>
                    <td>{{ $cours->formation->intitule }}</td>
                    <td>{{ $cours->etudiants()->count() }}</td>
                    @if($cours->plannings->count() > 0)
                @foreach($cours->plannings as $planning)
                    <td>{{ $planning->date_debut }}</td>
                    <td>{{ $planning->date_fin }}</td>
                     <td><a href = "/modifySeance/{{$planning->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
  <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
</svg></a></td>
            <td><a href = "/deleteSeance/{{$planning->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-x-fill" viewBox="0 0 16 16">
  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6.854 8.146 8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 1 1 .708-.708z"/>
</svg></a></td>
                @endforeach
            @else
                <td>no date</td>
                <td>no date</td>
            @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

