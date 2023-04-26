@extends('template/base')

@section('content')
  <h1>Liste de tous les cours où vous êtes inscrits</h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th>Intitulé</th>
        <th>Enseignant et etudiants</th>
        <th>Date de début</th>
        <th>Date de fin</th>
      </tr>
    </thead>
    <tbody>
      @foreach($coursInscrits as $cours)
        <tr>
          <td>{{ $cours->intitule }}</td>
          <td>
          @foreach($cours->enseignants as $enseignant)
          {{ $enseignant->nom }} {{ $enseignant->prenom }}<br>
          @endforeach
          </td>
          @if($cours->plannings->count() > 0)
                @foreach($cours->plannings as $planning)
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



