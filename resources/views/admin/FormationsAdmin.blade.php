@extends('template/base')

@section('content')


<h1>Liste des formations</h1>
<table class ="table table-striped table-dark">
  <thead>
    <tr>
      <th>ID</th>
      <th>Formations</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($formations as $formation)
    <tr>
      <td>{{ $formation->id }}</td>
      <td>{{ $formation->intitule }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $formations->links() }}
@endsection