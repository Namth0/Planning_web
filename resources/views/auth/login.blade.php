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

    <h1 class="my-5 border-bottom">Connexion</h1>

    <form method="post">
        <div>
            <legend>Login</legend>
            <input type="text" name="login" class="form-control" value="{{old('login')}}">
        </div>
        <div>
            <legend>MDP</legend>
            <input type="password" class="form-control" name="mdp">
        </div>
        <input type="submit" class="btn btn-outline-dark" value="Envoyer">
        @csrf
    </form>
@endsection
