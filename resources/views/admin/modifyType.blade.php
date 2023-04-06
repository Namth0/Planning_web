@extends('template/base')

@section('content')
    <form method="post">

        @csrf
        <h1>Modifier le type</h1>

        <label for="type">type</label>
        <input type="text" placeholder="type" name="type" id="type" value="{{ $users->type }}" autofocus>
        
        <button type="submit">Envoyer</button>

    </form>
@endsection
