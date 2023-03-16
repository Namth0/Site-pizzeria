<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzaravel : @yield("title")</title>
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
            color: inherit;
            text-decoration: none;
        }

        header > a
        {
            text-decoration: none;
            color: aliceblue !important;
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


        main
        {
            min-height: calc(100vh - 75px);
            width: min(90%, 1000px);
            margin-inline: auto;
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

        img
        {
            max-height: 250px !important;
            max-width: 250px !important;
        }


        
    </style>

</head>
    <body>
        
        <header class="bg-dark text-light">
            <h1><a href="/home">Pizzaravel</a></h1>

            @guest()
                <a href="/login">Se connecter</a>
                <a href="/register">S'inscrire</a>
            @endguest

            @auth
                @if(Auth::user()->type == "cook")
                    <a href="/gestion">Gestion</a>
                     <a href="/accountCook">Mon compte</a>
                @endif
                @if(Auth::user()->type == "admin")
                    <a href="/add">Configuration</a>
                    <a href="/liste">Liste Pizza</a>
                    <a href="/commandes">Liste des Commandes trieés</a>
                     <a href="/modifyAdmin">Mon compte</a>
                     <a href="/deleteAdminOrCook">Supprimer</a>
                     <a href ="/create">Creer</a>
                     <a href="/allcommandes">Liste de toutes les commandes</a>
                     <a href="/modifyCook">cook MDP</a>
                @endif
                @if(Auth::user()->type == "user")
                    <a href="/commande">Ma commande</a>
                    <a href="/historical">Historique</a>
                    <a href="/account">Mon compte</a>
                    <a href="/panier">Panier</a>
                    <a href="/untreated">Non traitée</a>

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