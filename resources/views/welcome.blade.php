{{-- Permet d'étendre le fichier de base --}}
@extends('base')

{{-- Remplir la partie du titre --}}
@section('titre', 'Site de gestion des articles !')


{{-- Mettre du contenu dans la partie reservée  --}}
@section('contenu')

    <h1>{{__("Bienvenu sur la plateforme de gestion des article !")}}</h1>

@endsection
