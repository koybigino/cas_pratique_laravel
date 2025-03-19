@extends('base')

@section('titre',$article->exists ? "Modification de l'article $article->titre" : "Page de création d'un article")

@php
    $etiquettes_id = $article->etiquettes()->pluck("id")
@endphp

@section('contenu')
    <h1 class="text-center">{{ $article->exists ?  "Modification de l'article $article->titre" : "Page de création d'un article" }}</h1>

    <div>
        <form enctype="multipart/form-data" method="post" action="{{ $article->exists ? route("article.update", $article) : route("article.store") }}" class="form-group row gap-3 my-5 justify-content-center">
            @csrf
            @method($article->exists ? 'patch' : 'post')
            @if ($article->exists)
                <div class="col-4">
                    <img src={{$article->imageUrl()}} alt="image" srcset="" class="card-img-top">
                </div>
            @endif
            <div class="form-group col-10">
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <b class="text-danger">{{ $message }}</b>
                @enderror
            </div>

            <div class="form-group col-10">
                <label for="titre" class="form-label">Titre</label>
                <input value="{{old('titre', $article->titre)}}" type="text" name="titre" id="text" class="form-control">
                @error('titre')
                    <b class="text-danger">{{ $message }}</b>
                @enderror
            </div>

            <div class="form-group col-10">
                <label for="titre" class="form-label">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"> {{old('description', $article->description)}}</textarea>
                @error('description')
                    <b class="text-danger">{{ $message }}</b>
                @enderror
            </div>

            <div class="form-group col-10">
                <label for="categorie_id" class="form-label">Categorie</label>
                <select class="form-select" name="categorie_id" id="categorie_id">
                    <option value="">Choisir une categorie...</option>
                    @forelse ($categories as $c)
                        <option @selected(old('categorie_id', $c->id == $article->categorie_id)) value="{{ $c->id }}">{{ $c->titre }}</option>
                    @empty
                    @endforelse
                </select>
                @error('categorie_id')
                    <b class="text-danger fw-bold">{{ $message }}</b>
                @enderror
            </div>

            <div class="form-group col-10">
                <label for="etiquette_id" class="form-label">Etiquetes</label>
                <select multiple class="form-select" name="etiquette_id[]" id="etiquette_id">
                    @forelse ($etiquettes as $e)
                        <option @selected(old('etiquette_id', $etiquettes_id->contains($e->id))) value="{{ $e->id }}">{{ $e->titre }}</option>
                    @empty
                    @endforelse
                </select>
                @error('etiquette_id')
                    <b class="text-danger fw-bold">{{ $message }}</b>
                @enderror
            </div>

            <div class="col-10">
                <button type="submit" class="btn btn-primary w-100">{{ $article->exists ? "Editer" : "Creer" }}</button>
            </div>
        </form>
    </div>
@endsection