@extends('base')

@section('titre', 'Listing de tous les articles !')

@section('contenu')
    <h1 class="text-center">Listing de tous les articles !</h1>

    @auth
        @can('create', $articles[0])
            <div class="position-relative">
                <div class="position-absolute end-0">
                    <a href="{{ route('article.create') }}" class="btn-primary btn">Ajouter un Article</a>
                </div>
            </div>
        @endcan
    @endauth

    <div class="row justify-content-between gap-3 my-5">
        @forelse ($articles as $article)
            <div class="card col-3">
                <img src={{ $article->imageUrl() }} alt="" srcset="" class="card-img-top">
                <div class="card-body">
                    <p><b>Titre : </b> {{ $article->titre }} </p>
                    <p><b>Description : </b> {{ $article->description }} </p>
                    <p>
                    <div class="d-inline-block"><a href="{{ route('article.show', $article) }}"
                            class="btn btn-primary btn-sm">voir plus -></a></div>
                    @auth
                        @can('update', $article)
                            <div class="d-inline-block"><a href="{{ route('article.edit', $article) }}"
                                    class="btn mx-3 btn-warning btn-sm">editer</a></div>
                        @endcan
                        @can('delete', $article)
                            <form action="{{ route('article.destroy', $article) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">supprimer</button>
                            </form>
                        @endcan
                    @endauth
                    </p>
                </div>
            </div>

        @empty
            <h3>Aucun n'articles disponible !</h3>
        @endforelse
    </div>

    {{ $articles->links() }}
@endsection
