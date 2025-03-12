@extends('base')

@section('titre', 'Creation d\'un nouvel article')


@section('contenu')

    <fieldset class="card p-5">
        <legend>
            <b>Creation d'un nouvel article</b>
        </legend>
        <form enctype="multipart/form-data" class="form-group mt-5" action="" method="post">
            @csrf

            <div class="input-group mb-3 form-group">
                <label class="form-label" for="image_path">Selectionner une image <b class="text-danger">*</b></label>
                <input name="image_path" type="file" class="form-control" id="image_path">
                @if (session('err'))
                    <b class="invalid-feedback">
                        {{ session('err') }}
                    </b>
                @endif
                @error('image_path')
                    <b class="invalid-feedback">
                        {{ $message }}
                    </b>
                @enderror

            </div>

            <div class="mb-3 form-group">
                <label for="titre" class="form-label">Titre de l'article <b class="text-danger">*</b> </label>
                <input value="{{ old('titre') }}" id="titre" class="form-control" type="text" name="titre" placeholder="Entrer le titre...">
                @error('titre')
                    <b class="invalid-feedback">
                        {{ $message }}
                    </b>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <label for="motif" class="form-label">Motif de l'article</label>
                <input value="{{ old('motif') }}" id="motif" class="form-control" type="text" name="motif" placeholder="Entrer le titre...">
                @error('motif')
                    <b class="invalid-feedback">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <div class="mb-3 form-group">
                <label for="description" class="form-label">Description de l'article <b class="text-danger">*</b></label>
                <textarea id="description" class="form-control" name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <b class="invalid-feedback">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <div class="mb-3 form-group">
                <label for="categorie_id" class="form-label">Catégorie de l'article <b class="text-danger">*</b></label>
                <select id="categorie_id" class="form-select" name="categorie_id" cols="30" rows="10">
                    <option value="">Choisir une categorie...</option>
                    @foreach ($categories as $c)
                        <option value="{{$c->id}}">{{$c->nom}}</option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <b class="invalid-feedback">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <div class="mb-3 form-group">
                <label for="etiquettes_id" class="form-label">Etiquettes de l'article <b class="text-danger">*</b></label>
                <select multiple id="etiquettes_id" class="form-select" name="etiquettes_id[]" cols="30" rows="10">
                    @foreach ($etiquettes as $et)
                        {{-- @if ($c->id == $article->categorie_id)
                        <option selected value="{{ $c->id }}">{{ $c->nom }}</option>
                    @else
                        <option value="{{ $c->id }}">{{ $c->nom }}</option>
                    @endif --}}

                        <option value="{{ $et->id }}">{{ $et->nom }}</option>
                    @endforeach
                </select>
                @error('etiquettes_id')
                    <b class="invalid-feedback">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <div class="mb-3 form-group">
                <label for="auteur" class="form-label">Auteur de l'article <b class="text-danger">*</b></label>
                <input value="{{ old('auteur') }}" id="auteur" class="form-control" type="text" name="auteur" placeholder="Entrer le titre...">
                @error('auteur')
                    <b class="invalid-feedback">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </fieldset>

@endsection
