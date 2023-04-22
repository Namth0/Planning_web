@extends('template/base')

@section('content')


<h2>Cours associés à un enseignant :</h2>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>ID</th>
            <th>Intitulé du cours</th>
            <th>ID de l'enseignant</th>
            <th>ID de la formation</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cours as $cour)
            <tr>
                <td>{{ $cour->id }}</td>
                <td>{{ $cour->intitule }}</td>
                <td>{{ $cour->user_id }}</td>
                <td>{{ $cour->formation_id }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Associer un cours a un enseignant :</h2>
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
