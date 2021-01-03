@extends('dashboard')
@section('content')

    @foreach($randomGames as $jeu)
    <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">

        <div class="bg-dark me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">

            <div class="my-3 py-3">
                <h2 class="display-5">{{$jeu->nom}}</h2>
                <div class="d-flex justify-content-between col-md-3 p-lg-5 mx-auto my-1">
                    <div class="btn-group align-items-center">
                        <a href="{{ URL::route('jeu_show', $jeu->id) }}" class="btn btn-primary">Plus d'infos</a>
                        <a href="{{ URL::route('jeu_regles', $jeu->id) }}" class="btn btn-secondary">Voir les règles</a>
                    </div>
                </div>
            </div>
            <div class="bg-light shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                <img src="{{$jeu->url_media}}">
            </div>

        </div>

    </div>
    @endforeach

@endsection
