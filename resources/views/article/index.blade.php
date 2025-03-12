@extends('base')

@section('titre', 'Listing des articles')

@section('contenu')

    <h1>Ma Première vue sur Laravel !</h1>
    <div class="alert alert-success">Ajout de Bootstrap à notre vue</div>

    {{-- {{ $article["titre"] }} --}}
    <div class="row gap-3 justify-content-between">
        {{-- @foreach ($articles as $article) --}}

        @forelse ($articles as $article)
        <div class="card col-md-5">
            <img class="w-100" src={{ asset($article['image_path']) }} class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Description : <b>{{ $article['titre'] }}</b></h5>
                <p class="card-text">Auteur <b>{{ $article['auteur'] }}</b></p>
                <p class="card-text">Categorie : <b>{{ $article['categorie'] }}</b></p>
                {{-- <a href={{route('article.affiche', ['motif'=> $article->motif, 'id' => $article->id])}} class="btn btn-primary">Voir plus -></a> --}}
                <a class="btn btn-primary"><b>Voir plus -></b></a>

                <a class="btn btn-warning m-1 p-1"><span class="badge text-bg-warning">Editer</span></a>
                <a class="btn btn-danger m-1 p-1"><span class="badge text-bg-danger">Supprimer</span></a>
            </div>
        </div>
        @empty
            <h2>Pas d'articles</h2>
        @endforelse
        {{-- @endforeach --}}
    </div>
            

@endsection
