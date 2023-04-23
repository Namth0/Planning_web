@extends('template/base')

@section('content')

    <form method="post" action="">

        @csrf
        <h1>Modifier un élément</h1>

        <label for="intitule">intitule</label>
        <input type="text" placeholder="Intitule" name="intitule" id="intitule" value="{{$formation->intitule}}"  autofocus>
    
        <button type="submit">Envoyer la modification</button>

    </form>

@endsection