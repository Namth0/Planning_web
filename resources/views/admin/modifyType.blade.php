@extends('template/base')

@section('content')
    <form method="post">

        @csrf
        <h1>Modifier le type</h1>

    <label for="type">Type</label>
    <select name="type" id="type">
        
        @if ($users->formation_id == null)
            <option value="enseignant" {{ $users->type == "enseignant" ? "selected" : "" }}>Enseignant</option>
            <option value="admin" {{ $users->type == "admin" ? "selected" : "" }}>Admin</option>
        @else 
            <option value="etudiant" {{ $users->type == "etudiant" ? "selected" : "" }}>Etudiant</option>

        @endif
    </select>

    <button type="submit">Envoyer</button>

    </form>
@endsection
