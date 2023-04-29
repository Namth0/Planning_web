@extends('template.base')

@section('content')

    <h1>Liste du planning personnalisé par semaine</h1>

    @foreach($coursParSemaine as $semaine => $plannings)

        <h2>Semaine {{ $semaine }}</h2>

        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Heure début</th>
                    <th>Heure fin</th>
                    <th>Intitulé</th>
                    <th>Formation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plannings as $index => $planning)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($planning->date_debut)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($planning->date_fin)) }}</td>
                        <td>{{ date('H:i', strtotime($planning->date_debut)) }}</td>
                        <td>{{ date('H:i', strtotime($planning->date_fin)) }}</td>
                        <td>
                            @if($planning->cours && $planning->cours->intitule)
                                {{ $planning->cours->intitule }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($planning->cours && $planning->cours->formation && $planning->cours->formation->intitule)
                                {{ $planning->cours->formation->intitule }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endforeach

@endsection