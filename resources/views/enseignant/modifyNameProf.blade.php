@extends('template/base')

@section('content')

<form method="post">
    @csrf
    <div class="form-group">
        <label for="newName">Nouveau nom :</label>
        <input type="text" name="newName" class="form-control" id="newName" placeholder="Entrez votre nouveau nom" value="{{ old('newName') }}">
    </div>
    <div class="form-group">
        <label for="newLastName">Nouveau nom de famille :</label>
        <input type="text" name="newLastName" class="form-control" id="newLastName" placeholder="Entrez votre nouveau nom de famille" value="{{ old('newLastName') }}">
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

@endsection
