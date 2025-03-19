<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Etiquette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{

    public function __construct(){
        // $this->middleware("auth", ["except" => ["show", "index"]]);
        $this->middleware(["auth", "verified"])->except(["show", "index"]);
    }

    
    /**
     * Display a listing of the resource.
     * 
     * Affiche le listing des ressources
     * Nom de la route : nom_de_la_ressource.index
     */

    public function index()
    {
        return view("article.index", [
            "articles" => Article::orderBy('created_at', 'desc')->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * Affiche le formulaire de création de la ressource
     * Nom de la route : nom_de_la_ressource.create
     */
    public function create()
    {
        return view("article.create", [
            "article" => new Article(),
            "categories" => Categorie::all(),
            "etiquettes" => Etiquette::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Sauvegarde la ressource créer en bd
     * Nom de la route : nom_de_la_ressource.store
     */
    public function store(Request $request)
    {

        $titre = $request->input('titre');
        $validator = Validator::make([
            "titre" => $titre,
            "description" => $request->input('description'),
            "image" => $request->file('image'),
            "categorie_id" => $request->input("categorie_id"),
            "etiquette_id" => $request->input("etiquette_id")
        ],
        [
            "titre" => ["required", "min:4", "max:50", "unique:articles"],
            "description" => "required|min:4",
            "image" => "image|required",
            "categorie_id" => ["int", "required", "exists:categories,id"],
            "etiquette_id" => ["array", "required", "exists:etiquettes,id"]
        ]);

        $datas = $validator->validated();

        // dd($datas);

        $image = $datas["image"];
        $etiquettes_id = $datas["etiquette_id"];

        $chemin_image = $image->store("uploads", "public");

        // dd($chemin_image);
        $datas["image"] = $chemin_image;

        $article = Article::create($datas);

        $article->etiquettes()->sync($etiquettes_id);

        return redirect()->route("article.index")->with('success', "l'article $titre a bien été crée!");
    }

    /**
     * Display the specified resource.
     * 
     * Affiche ube ressource spécifique en lui passant l'id de la resource
     * Nom de la route : nom_de_la_ressource.show
     */
    public function show(Article $article)
    {
        return view("article.show", [
            "article" => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * Affiche le formulaire d'édition d'un aricle
     * Nom de la route : nom_de_la_ressource.edit
     */
    public function edit(Article $article)
    {
        return view("article.create", [
            "article" => $article,
            "categories" => Categorie::all(),
            "etiquettes" => Etiquette::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * Sauvegarde la ressource modifié en bd
     * Nom de la route : nom_de_la_ressource.update
     */
    public function update(Request $request, Article $article)
    {
        $titre = $request->input('titre');
        $validator = Validator::make([
            "titre" => $titre,
            "description" => $request->input('description'),
            "categorie_id" => $request->input("categorie_id"),
            "etiquette_id" => $request->input("etiquette_id")
        ],
        [
            "titre" => ["required", "min:4", "max:50", Rule::unique('articles')->ignore($article)],
            "description" => "required|min:4",
            "categorie_id" => ["int", "required", "exists:categories,id"],
            "etiquette_id" => ["array", "required", "exists:etiquettes,id"]
        ]);

        $datas = $validator->validated();


        // dd($datas);

        if($request->file('image')){
            $image = $request->file('image');
    
            Storage::disk("public")->delete($article->image);

            $chemin_image = $image->store("uploads", "public");
        } else {
            $chemin_image = $article->image;
        }

        // dd($chemin_image);
        $datas["image"] = $chemin_image;
        $etiquettes_id = $datas["etiquette_id"];


        $article->update($datas);

        $article->etiquettes()->sync($etiquettes_id);

        return redirect()->route("article.index")->with('success', "l'article $titre a bien été mis à jour!");
    }

    /**
     * Remove the specified resource from storage.
     * 
     * Suprime une ressource
     * Nom de la route : nom_de_la_ressource.destroy
     */
    public function destroy(Article $article)
    {
        $titre = $article->titre;
        Storage::disk("public")->delete($article->image);
        $article->delete();

        return redirect()->route("article.index")->with('success', "l'article $titre a bien été supprimé!");
    }
}
