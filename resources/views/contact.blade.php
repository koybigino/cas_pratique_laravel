@extends("base")


@section('titre', "Contact")

@section('contenu')
<fieldset class="card p-5">
    <legend>
        <b>Nous Contacter</b>
    </legend>
    <form class="form-group mt-5" action="" method="post">
        @csrf
        <div class="mb-3 form-group">
            <label for="nom" class="form-label">Entrer votre nom : <b class="text-danger">*</b> </label>
            <input value="{{ old('titre',  Auth::user()?->name) }}" id="nom" class="form-control" type="text" name="nom"
                placeholder="Entrer le titre...">
            @error('nom')
                <b class="text-danger text-sm">
                    {{ $message }}
                </b>
            @enderror
        </div>
        <div class="mb-3 form-group">
            <label for="email" class="form-label">Votre Email :<b class="text-danger">*</b></label>
            <input value="{{ old('email', Auth::user()?->email) }}" id="email" class="form-control" type="email" name="email"
                placeholder="Entrer le titre...">
            @error('email')
                <b class="text-danger text-sm">
                    {{ $message }}
                </b>
            @enderror
        </div>
        
        <div class="mb-3 form-group">
            <label for="message" class="form-label">Votre message : <b class="text-danger">*</b></label>
            <textarea id="message" class="form-control" name="message" id="" cols="30" rows="10">{{ old('message') }}</textarea>
            @error('message')
                <b class="text-danger text-sm">
                    {{ $message }}
                </b>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</fieldset>

@endsection