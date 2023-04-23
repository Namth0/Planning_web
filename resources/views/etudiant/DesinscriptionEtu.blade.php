@extends('template/base')

@section('content')
  <h1>Désinscription d'un cours</h1>
  <form method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Désinscription</button>
  </form>
@endsection
