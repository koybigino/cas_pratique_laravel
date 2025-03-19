<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;


    protected $fillable = ["titre", "description", "image", "categorie_id"];

    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }

    public function etiquettes() {
        return $this->belongsToMany(Etiquette::class);
    }

    public function imageUrl(){
        return Storage::disk('public')->url($this->image);
    }
}
