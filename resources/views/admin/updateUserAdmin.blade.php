
@extends('template/base')

@section('content')

<form method="POST">
    @csrf

    <!-- Champs pour la modification des données de l'utilisateur -->
    <label for="login">Login :</label>
    <input type="text" name="login" value="{{ $utilisateur->login }}" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" value="{{ $utilisateur->prenom }}" required>

    <label for="nom">Nom :</label>
    <input type="text" name="nom" value="{{ $utilisateur->nom }}" required>

    <label for="type">Type :</label>
    <select name="type" required>
        <option value="enseignant" @if ($utilisateur->type === 'enseignant') selected @endif>enseignant</option>
        <option value="etudiant" @if ($utilisateur->type === 'etudiant') selected @endif>etudiant</option>
        <option value="admin" @if ($utilisateur->type === 'admin') selected @endif>admin</option>
    </select>

    <!-- Bouton de soumission -->
    <button type="submit">Modifier</button>
</form>

@endsection
