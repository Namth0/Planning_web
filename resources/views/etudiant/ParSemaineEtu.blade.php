@extends('template.base')

@section('content')

    <h1>Liste des cours par semaine</h1>

    @foreach($coursParSemaine as $semaine => $cours)

        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Intitulé</th>
                    <th>Formation</th>
                    <th>Date debut</th>
                    <th>Date Fin</th>
                </tr>
            </thead>
            <tbody>
        @foreach($cours as $c)
        <tr>
            <td>{{ $c->intitule }}</td>
            <td>{{ $c->formation->intitule }}</td>
    @if($c->plannings->count() > 0)
                @foreach($c->plannings as $planning)
                    <td>{{ $planning->date_debut }}</td>
                    <td>{{ $planning->date_fin }}</td>
                @endforeach
            @else
                <td>no date</td>
                <td>no date</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endforeach

@endsection