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
            width: 22rem;
            margin-right: 1rem;
        }
        
    </style>

   <h1 class="my-5 border-bottom">Inscription</h1>

<form method="post">
    <div>
        <legend class ="fs-5">prenom</legend>
        <input class="form-control" type="text" name="prenom">
    </div>
    <div>
        <legend class ="fs-5">nom</legend>
        <input class="form-control" type="text" name="nom">
    </div>
    <div>
        <legend class="fs-5">Login</legend>
        <input class="form-control" type="text" name="login" value="{{old('login')}}">
    </div> 
    <div>
        <legend class="fs-5">Choix du type</legend>
        <select name="type" id="type">
            <option value="">-- Choisissez le type --</option>
            <option value="admin">Admin</option>
            <option value="enseignant">Enseignant</option>
        </select>
    </div>
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
        <legend class="fs-5">MDP</legend>
        <input class="form-control" type="password" name="mdp">
    </div>
    <div>
        <legend class="fs-5">Confirmation MDP</legend>
        <input class="form-control" type="password" name="mdp_confirmation">
    </div>
    <input type="submit" value="Envoyer" class="btn btn-outline-dark">
    @csrf
</form>


@endsection
