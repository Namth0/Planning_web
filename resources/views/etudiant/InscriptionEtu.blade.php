@extends('template/base')

@section('content')
  <h1>Inscription à un cours</h1>
  <form method="POST">
    @csrf
    <div class="form-group">
      <label for="cours">intitule du cours</label>
        <input type="text" placeholder="Cours" name="cours" id="cours" value="{{$cours->intitule}}"  autofocus>
    </div>
    <button type="submit" class="btn btn-primary">Inscription</button>
  </form>
@endsection
