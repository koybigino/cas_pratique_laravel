@extends('base')

@section('titre', 'Login')

@section('contenu')
    <h2 class="text-center">Login Page</h2>
    <form action="" method="post" class="form-group row gap-3 justify-content-center">
        @csrf
        <div class="form-group col-10">
            <label for="email" class="form-label">Email</label>
            <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control">
            @error('email')
                <b class="text-danger">{{ $message }}</b>
            @enderror
        </div>

        <div class="form-group col-10">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
                <b class="text-danger">{{ $message }}</b>
            @enderror
        </div>

        <div class="col-10 form-group">
            <button type="submit" class="btn w-100 btn-primary">Se connecter</button>
        </div>
    </form>
@endsection
