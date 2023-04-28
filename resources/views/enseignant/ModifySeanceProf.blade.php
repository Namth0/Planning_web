@extends('template/base')

@section('content')

<form method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="date_debut">Date de début :</label>
        <input type="date" name="date_debut" id="date_debut" value="{{ \Carbon\Carbon::parse($seance->date_debut)->toDateString() }}" required>
    </div>
    <div>
        <label for="date_fin">Date de fin :</label>
        <input type="date" name="date_fin" id="date_fin" value="{{ \Carbon\Carbon::parse($seance->date_fin)->toDateString() }}" required>
    </div>
    <button type="submit">Mettre à jour la séance</button>
</form>

@endsection


