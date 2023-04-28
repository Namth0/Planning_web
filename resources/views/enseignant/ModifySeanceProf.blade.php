@extends('template/base')

@section('content')

<form method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="date_debut">Date de début :</label>
        <input type="date" name="date_debut" id="date_debut" value="{{ $seance->date_debut }}" required>
    </div>
    <div>
        <label for="heure_debut">Heure de début :</label>
        <input type="time" name="heure_debut" id="heure_debut" value="{{ \Carbon\Carbon::parse($seance->date_debut)->format('H:i') }}" required>
    </div>
    <div>
        <label for="date_fin">Date de fin :</label>
        <input type="date" name="date_fin" id="date_fin" value="{{ $seance->date_fin }}" required>
    </div>
    <div>
        <label for="heure_fin">Heure de fin :</label>
        <input type="time" name="heure_fin" id="heure_fin" value="{{ \Carbon\Carbon::parse($seance->date_fin)->format('H:i') }}" required>
    </div>
    <button type="submit">Mettre à jour la séance</button>
</form>

@endsection

