@extends('template/base')

@section('content')

   <div class="container">
        <h1>Ajouter un enseignant à un cours</h1>
        <form method="POST">
            @csrf
            <div class="form-group">
                <label for="id">Cours :</label>
                <select class="form-control" name="id">
                    @foreach($cours as $c)
                        <option value="{{ $c->id }}">{{ $c->intitule }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="professeur_id">Enseignant :</label>
                <select class="form-control" name="professeur_id">
                    @foreach($profs as $prof)
                        <option value="{{ $prof->id }}">{{ $prof->nom }} {{ $prof->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Associer</button>
        </form>
    </div>

@endsection
