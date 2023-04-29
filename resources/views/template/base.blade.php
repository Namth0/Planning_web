<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning @yield("title")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <style>


        *,
        *::before,
        *::after
        {
            margin: 0;
            padding: 0;
            color: inherit;
        }

       input[type="text"],
button {
  padding: 10px 15px;
  font-size: 16px;
  border-radius: 5px;
  border: none;
  background-color: #f2f2f2;
}

input[type="text"] {
  width: 200px;
  border: 1px solid #ccc;
}

button {
  color: white;
  background-color: #337ab7;
  cursor: pointer;
}

button:hover {
  background-color: #135b9e;
}
select {
  padding: 10px 15px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ccc;
  background-color: #f2f2f2;
  width: 200px;
}

select:hover {
  border-color: #999;
}

select:focus {
  outline: none;
  border-color: #337ab7;
  box-shadow: 0 0 5px rgba(51, 122, 183, 0.5);
}


        a.btn.btn-primary{
            color : #080871;
        }


        body
        {
            min-height: 100dvh;
            min-height: 100vh;
            min-width: 100dvw;
            min-width: 100vw;
            display: flex;
            flex-direction: column;
        }


        header 
        {
            height: 75px;
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 2rem;
            overflow-x: scroll;
            scrollbar-width: thin !important;
        }


        header > h1
        {
            margin-inline: 2rem;
        }

        header > h1 > a
        {
            color: dark;
            text-decoration: none;
        }

        header > a
        {
            text-decoration: none;
            color: dark !important;
            position: relative;
        }

        header >  a::before
        {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: aliceblue;
            transition: 250ms;
        }

        header >  a:hover::before
        {
            width: 100%;
        }

        h1 {
            color : #080871;
        }
        h2 {
            color : #080871;
        }

        h4 {
            color : #080871;
        }
        
        
        legend {
            color : #080871;
        }

        .table-container {
  overflow: hidden;
  border-radius: 10px;
}

table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
}

th,
td {
  padding: 10px;
}

th {
  background-color: #f2f2f2;
}

th:first-child,
td:first-child {
  border-top-left-radius: 10px;
}

th:last-child,
td:last-child {
  border-top-right-radius: 10px;
}

tr:last-child td:first-child,
tr:last-child td:last-child {
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}



        main
        {
            min-height: calc(100vh - 75px);
            width: min(90%, 1000px);
            margin-inline: auto;
            background-color: radial-gradient(red, blue);
        }

        header {
             background-color: #080871;
        }

        body {
            background: radial-gradient(blue, grey);
        }

        /* Ajoute ce style dans ton fichier CSS */

    h1.my-5.border-bottom {
       
        color : #080871;
        border-bottom: 2px solid black;
        }
    ul.my-5.border-bottom {
        color : #080871;
    }

        p.my-5 {
            
            color : #080871;
            font-size: 18px;
        }
        p{
            
            color : #080871;
            font-size: 18px
        }
        .bubble
        {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            width: auto;
            height: auto;
            padding: 1rem;
        }



        .titre {
  margin-bottom: 20px;
}

.form-recherche {
  margin-bottom: 20px;
}

.input-recherche {
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.btn-recherche {
  padding: 10px 20px;
  border-radius: 5px;
  background-color: #337ab7;
  color: white;
  border: none;
}

.btn-group {
  margin-top: 20px;
}

.btn-group .btn {
  margin-right: 10px;
}


        
    </style>

</head>
    <body>
        
        <header>
            <h1><a href="/home">Planning</a></h1>

            @guest()
                <a href="/login">Se connecter</a>
                <a href="/register">S'inscrire</a>
            @endguest

            @auth
                @if(Auth::user()->type == "etudiant")
                <a href="/accountEtu">Mon compte</a>
                <a href="/formations">Cours de la formation</a>
                <a href="/courses">Mes cours</a>
                <a href = "/perCoursEtu">Par Cours</a>
                <a href = "/perSemaineEtu">Par Semaine</a>
                  
                @endif
                @if(Auth::user()->type == "enseignant")
                <a href="/accountProf">Mon compte</a>
                <a href = "/responsable">Mes cours</a>
                <a href = "/perCours">Par Cours</a>
                <a href = "/perSemaine">Par Semaine</a>

                    
                @endif
                @if(Auth::user()->type == "admin")
                <a href="/config">Configuration</a>
                <a href="/add">Ajouter formation</a>
                <a href="/addCours">Ajouter cours</a>
                <a href="/cours">Cours</a>
                <a href="/formation">Formations</a>
                <a href="/rechercher">Rechercher cours</a>
                <a href = "/ProfAndCours">Enseignant et cours</a>
                <a href ="/creerUser">Creer user</a>
                <a href="/gerer">Gestion planning</a>
                @endif
                <a href="/logout">Déconnexion</a>
            @endauth
        </header>

        <main>
            @yield("content")
        </main>

        <footer>
            @if ($errors->any())
                <div class="error">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li class="fg-danger">{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </footer>

        @if( session()->has('etat'))
            <p class="bg-success text-light bubble">{{session()->get('etat')}}</p>
        @endif

        @if( session()->has('error'))
            <p class="bg-danger text-light bubble">{{session()->get('error')}}</p>
        @endif

        @section('footer')
        
    </body>
</html>