<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="La Vik Team">
    <title>VikGames - Formulaire</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/product/">



    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="icon" href="{{asset('images/favicon.ico')}}">
    <meta name="theme-color" content="#7952b3">


    <style >
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
        <a class="py-2 d-none d-md-inline-block" href="rechercher">Rechercher</a>

        <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="px-4 py-2 block  text-black hover:bg-grey-light" type="submit">Déconnexion</button>
            </form>
        </div>
    </nav>
</header>

<div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card-body">
    <div class="col-md-8 p-lg-10 mx-auto my-10">
    <form name="form-create-jeu" method="post" action="{{ URL::route('jeu_store') }}">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" class="form-control" required="">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required="">
                    {{ old('description') }}
                </textarea>
        </div>

        <div class="form-group">
            <label for="regles">Règles</label>
            <textarea name="regles" class="form-control" required="">
                {{ old('regles') }}
            </textarea>
        </div>


        <div class="form-group">
            <label for="langue">Langue</label>
            <input type="string" name="langue" value="{{ old('langue') }}" class="form-control" required="" >
        </div>

        <div class="form-group">
            <label for="url_media">Url-media</label>
            <input type="string" name="url_media" value="{{ old('url_media') }}" class="form-control" required="" >
        </div>

        <div class="form-group">
            <label for="age">Âge</label>
            <input type="integer" name="age" value="{{ old('age') }}" class="form-control" required="" >
        </div>

        <div class="form-group">
            <label for="nombre_joueurs">Nombre de joueurs</label>
            <input type="integer" name="nombre_joueurs" value="{{ old('nombre_joueurs') }}" class="form-control" required="" >
        </div>

        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <input type="string" name="categorie" value="{{ old('categorie') }}" class="form-control" required="" >
        </div>

        <div class="form-group">
            <label for="duree">Durée</label>
            <input type="string" name="duree" value="{{ old('duree') }}" class="form-control" required="" >
        </div>

        <div class="form-group">
            <label for="description">Thème</label>
            <select name="theme">
                @foreach( \App\Models\Theme::all() as $theme)
                    @if (old('theme') == $theme->id)
                        <option value="{{ $theme->id }}" selected>{{ $theme->nom }}</option>
                    @else
                        <option value="{{ $theme->id }}">{{ $theme->nom }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Editeur</label>
            <select name="editeur">
                @foreach( \App\Models\Editeur::all() as $editeur)
                    @if (old('editeur') == $editeur->id)
                        <option value="{{ $editeur->id }}" selected>{{ $editeur->nom }}</option>
                    @else
                        <option value="{{ $editeur->id }}">{{ $editeur->nom }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
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


<script src="{{asset('js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>


</body>
</html>


