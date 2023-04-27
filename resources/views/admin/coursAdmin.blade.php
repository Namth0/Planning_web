@extends('template/base')

@section('content')


<h1>Cours associés à un enseignant :</h1>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>ID</th>
            <th>Intitulé du cours</th>
            <th>ID de l'enseignant</th>
            <th>ID de la formation</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cours as $cour)
            <tr>
                <td>{{ $cour->id }}</td>
                <td>{{ $cour->intitule }}</td>
                <td>{{ $cour->user_id }}</td>
                <td>{{ $cour->formation_id }}</td>
                <td><a href ="/modifyCours/{{$cour->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></a></td>
                <td><a href ="/deleteCours/{{$cour->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">
  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg></a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<h1>Associer un cours a un enseignant :</h1>
<ul> ATTENTION OBLIGATOIRE D'ASSSOCIER LE MEME/UN ENSEIGNANT A UN COURS APRES AVOIR FAIT AJOUTER UN COURS !!!</ul>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Associer un prof a un cours</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($cours as $cour) --}}
            <tr>
                <td>
                    <a href="/associer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-intersect" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm5 10v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-2v5a2 2 0 0 1-2 2H5zm6-8V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2V6a2 2 0 0 1 2-2h5z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        {{-- @endforeach --}}
    </tbody>
</table>



@endsection
