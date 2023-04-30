@extends('template/base')

@section('content')

  <style>
        form
        {
            width: 500px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-inline: auto;
            margin-block: 4rem;
        }

        form > div
        {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        form > div > legend
        {
            width: 5rem;
            margin-right: 1rem;
        }

        ul {
  font-weight: bold;
}

        
    </style>
    <h4>!!! N'oublie de voir en bas pour pouvoir modifier le Nom et Prenom !!! </h4>


    <h1 class="my-5 border-bottom">Modification mots de passe Etudiant</h1>

    <form method="post">
        <div>
            <legend for="mdpactuel">Ancien mots de passe</legend>
            <input type="password" class="form-control" name="mdpactuel">
        </div>
        <div>
            <legend for="Nouveaumdp">Nouveau mots de passe</legend>
            <input type="password" class="form-control" name="Nouveaumdp">
        </div>

        <div>
         <label for="Nouveaumdp_confirmation">Confirmez le nouveau mot de passe</label>
    <input type="password" class="form-control" id="Nouveaumdp_confirmation" name="Nouveaumdp_confirmation">
        </div>

        <input type="submit" class="btn btn-outline-dark" value="Envoyer">
        @csrf
    </form>


      <h1 class="my-5 border-bottom">Modifier nom et prenom  </h1>
    <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th>Option</th>
      <th>Appuyer sur l'icon </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Modifier</td>
      <td><a href ="/modify-nom-prenom-etu"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
  <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
</svg></a></td>
    </tr>
  </tbody>
</table>
@endsection