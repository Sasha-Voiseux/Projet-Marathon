<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="La Vik Team">
    <title>VikGames - Profil</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/product/">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="icon" href="{{asset('images/favicon.ico')}}">
    <meta name="theme-color" content="#7952b3">

    <style>

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="{{asset('css/product.css')}}" rel="stylesheet">
</head>
<body>
<header class="site-header sticky-top py-1">
    <nav class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="#" aria-label="Product">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
        </a>
        <a class="py-2 d-none d-md-inline-block" href="dashboard">Accueil</a>
        <a class="py-2 d-none d-md-inline-block" href="/listeJeuxPages">Liste des jeux</a>
        <a class="py-2 d-none d-md-inline-block" href="profil">Profil</a>

        <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="px-4 py-2 block  text-black hover:bg-grey-light" type="submit">Déconnexion</button>
            </form>
        </div>

    </nav>
</header>

<script src="{{asset('js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
<main>
    <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
        <div class="bg-dark me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
            <div class="my-3 py-3">
                <h2 class="display-5">Ma ludothèque</h2>
                <p class="lead">
                    <div class="container">
                        <a href="{{URL::route('profil')}}" class="btn btn-primary">Retourner au profil</a>
                        @if(!empty($jeux))
                            @foreach($jeux as $jeu)
                                <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
                                    <div class="col">
                                        <div class="card shadow-sm">
                                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$jeu->nom}}</text></svg>
                                            <div class="card-body">
                <p class="card-text">
                <ul style="color: black">
                    <li> Catégorie : {{$jeu->categorie}}</li>
                    <li> Durée de partie : {{$jeu->duree}}</li>
                    <li> Nombre de joueurs : {{$jeu->nombre_joueurs}}</li>
                    <li> Description : {{$jeu->description}}</li>

                </ul>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ URL::route('jeu_show', $jeu->id) }}" class="btn btn-primary">Plus d'infos</a>
                        <a href="{{ URL::route('jeu_regles', $jeu->id) }}" class="btn btn-secondary">Voir les règles</a>
                        <a href="{{ URL::route('supprimerA', $jeu->id) }}" class="btn btn-danger">Supprimer le jeu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    @endforeach
    @else
        <h3>Aucun jeu</h3>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

    </div>
    </div>
    </div>

</main>


<footer class="container py-5">
    <div class="row">
        <div class="col-12 col-md">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mb-2" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
            <small class="d-block mb-3 text-muted">&copy; 2020</small>
        </div>
        <div class="col-6 col-md">
            <h5>La Vik Team</h5>
            <ul class="list-unstyled text-small">
                <li>Mathieu Maes</li>
                <li>Océane Pouilly</li>
                <li>Guillaume Vandeville</li>
                <li>Sasha Voiseux</li>
                <li>Germain Poloudenny</li>
                <li>Camille Plaska</li>
            </ul>
        </div>
    </div>
</footer>

</body>
</html>




