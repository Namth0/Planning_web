@extends('template/base')

@section('content')
    <h1>Liste des cours par enseignant</h1>

   

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>Enseignant</th>
                <th>Cours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enseignants as $enseignant)
                <tr>
                    <td>{{ $enseignant->nom }}</td>
                    <td>
                        <ul>
                            @foreach ($enseignant->coursEnseignant as $cours)
                                <li>{{ $cours->intitule }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

     @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection

