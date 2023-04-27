@extends('template/base')

@section('content')

<form method="post">
    @csrf
    <div class="form-group">
        <label for="intitule">Nouveau nom :</label>
        <input type="text" name="intitule" class="form-control" id="intitule" placeholder="Entrez le nouveau nom du cours" value="{{ old('intitule') }}">
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

@endsection