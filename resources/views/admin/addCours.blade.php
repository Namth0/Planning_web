@extends('template/base')

@section('content')


<style>
  form
        {
            width: 500px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-inline: auto;
            margin-block: 4rem;
        }

        form > div
        {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        form > div > legend
        {
            width: 5rem;
            margin-right: 1rem;
        }  
</style>

<h1 class ="my-5 border-bottom">Ajouter une formation</h1>

<form method="post">   
        <label for="age">Intitulé du cours</label>
        <input type="text" placeholder="intitule" name="intitule" id="intitule" required>
        <div>
  <legend class="fs-5">Choix de la formation</legend>
        <select name="formation" id="formation">
            <option value="">-- Choisissez la formation --</option>
            @foreach($formations as $formation)
                <option value="{{$formation->id}}">{{$formation->intitule}}</option>
            @endforeach
        </select>
    </div>
    <div>
  <legend class="fs-5">Enseignant associé au cours</legend>
        <select name="user" id="user">
            <option value="">-- Choisissez l'enseignant --</option>
            @foreach($enseignants as $enseignant)
                <option value="{{$enseignant->id}}">{{$enseignant->nom}}</option>
            @endforeach
        </select>
</div>



        <input type="submit" class="btn btn-outline-dark" value="Envoyer">
        @csrf 
</form>
@endsection


