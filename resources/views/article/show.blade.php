@extends('base')

@section('titre', "Details de l'article $article->titre")

@section('contenu')

    <h1 class="text-center">Details de l'article {{ $article->titre }}</h1>
    <img src={{$article->imageUrl()}} alt="" srcset="" class="card-img-top">
    <p><b>Titre : </b> {{ $article->titre }} </p>
    <p><b>Description : </b> {{ $article->description }} </p>
    <p class="card-text"> <b>Categories :</b> {{ $article->categorie?->titre }}</p>
    <p class="card-text"><b>Etiquettes : </b>
        @foreach ($article->etiquettes as $et)
            <span class="badge bg-dark">{{ $et->titre }}</span>
        @endforeach
    </p>
@endsection
