@extends('template/base')

@section('content')

<h1>Liste des cours de la formation {{ $formation->intitule }}</h1>

   <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Intitulé</th>
                    <th>Enseignant(s)</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection



