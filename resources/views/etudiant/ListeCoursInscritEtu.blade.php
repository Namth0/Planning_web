@extends('template/base')

@section('content')
  <h1>Liste des cours inscrits</h1>
  <ul>
    @foreach($coursInscrits as $cours)
      <li>{{ $cours->intitule }}</li>
    @endforeach
  </ul>
@endsection



