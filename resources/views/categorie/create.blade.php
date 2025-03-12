@extends('base')


@section('titre', "creation d'une categorie")

@section('contenu')

    <div class="card my-5 p-5">
        <h1 class="text-center">Création d'une nouvelle catégorie</h1>
        <form action="{{route("categorie.store")}}" method="post" class="form-group">
            @csrf

            <div class="row g-3 justify-content-center">
                <div class="col-12">
                    <label for="titre" class="form-label fw-bold">Titre : </label>
                    <input type="text" name="titre" id="titre" class="form-control">
                </div>

                <div class="col-1">
                    <button type="submit" class="btn fw-bold w-100 btn-primary">Créer</button>
                </div>
            
            </div>
        </form>
    </div>

@endsection
