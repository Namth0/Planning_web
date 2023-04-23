@extends('template/base')

@section('content')


<h1>Liste des formations</h1>
<table class ="table table-striped table-dark">
  <thead>
    <tr>
      <th>ID</th>
      <th>Formations</th>
      <th>Modifier la formation</th>
      <th>Supprimer la formation</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($formations as $formation)
    <tr>
      <td>{{ $formation->id }}</td>
      <td>{{ $formation->intitule }}</td>
      <td><a href ='/modifyFormation/{{$formation->id}}/'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2 13.5a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 0-1H3.707L13.854 2.854a.5.5 0 0 0-.708-.708L3 12.293V7.5a.5.5 0 0 0-1 0v6z"/>
</svg></a></td>
      <td><a href ='/deleteFormation/{{$formation->id}}/'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
</svg></a></td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $formations->links() }}
@endsection