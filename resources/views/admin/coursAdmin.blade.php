@extends('template/base')

@section('content')


<h1>Liste des Cours</h1>
<table class ="table table-striped table-dark">
  <thead>
    <tr>
      <th>ID</th>
      <th>Intitulé du cours</th>
      <th>ID de l'enseignant</th>
      <th>ID de la formation</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($cours as $cour)
    <tr>
      <td>{{ $cour->id }}</td>
      <td>{{ $cour->intitule }}</td>
      <td>{{ $cour->user_id }}</td>
      <td>{{ $cour->formation_id }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $cours->links() }}
@endsection