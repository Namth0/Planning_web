@extends('template/base')

@section('content')

<style>

button{
    background : radial-gradient(black, black);
    }
</style>
    <div style="margin-top: 20px;">
        <h1 style="margin-bottom: 20px;">Recherche par intitulé</h1>

        <form method="POST" style="margin-bottom: 20px;">
            @csrf
            <input type="text" name="intitule" placeholder="Rechercher par intitulé" style="padding: 5px;">
            <button type="submit" style="padding: 5px 10px; background-color: #4CAF50; color: white; border: none;">Rechercher</button>
        </form>

        @if ($resultats && isset($_POST['intitule']))
            <h2 style="margin-bottom: 10px;">Résultats de la recherche</h2>

            @if ($resultats->isEmpty())
                <p>Aucun résultat trouvé.</p>
            @else
                <ul style="list-style-type: disc; margin-left: 20px;">
                    @foreach ($resultats as $cours)
                        <li>{{ $cours->intitule }}</li>
                    @endforeach
                </ul>
            @endif
        @endif
    </div>
@endsection


