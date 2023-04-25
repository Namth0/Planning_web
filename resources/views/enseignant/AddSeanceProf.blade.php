@extends('template/base')

@section('content')

<div class="container">
    <h1>Ajouter une nouvelle séance de cours</h1>
    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="date_debut">Date de début :</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_fin">Date de fin :</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer une nouvelle séance</button>
    </form>
</div>
@endsection