

@extends('template/base')

@section('content')

<h1>Liste des cours de la formation {{ $formation->intitule }}</h1>
<form action="/formations/{{$formation->id}}/" method="POST">
@csrf
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="recherche" placeholder="Rechercher un cours" aria-label="Rechercher un cours" aria-describedby="button-recherche">
        <button class="btn btn-outline-secondary" type="submit" id="button-recherche">Rechercher</button>
    </div>
</form>
   <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Intitulé</th>
                    <th>Enseignant(s)/Etudiant(s)</th>
                    <th>Inscription</th>
                    <th>Desinscription</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cours as $c)
                    <tr>
                        <td>{{ $c->intitule }}</td>
                        <td>
                            @foreach($c->enseignants as $enseignant)
                                {{ $enseignant->nom }} {{ $enseignant->prenom }}<br>
                            @endforeach
                        </td>
                        <td><a href ="/InscriptionEtu/{{$c->id}}/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
</svg></a></td>
                        <td><a href = "/DesinscriptionEtu/{{$c->id}}/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
  <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
</svg></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection



