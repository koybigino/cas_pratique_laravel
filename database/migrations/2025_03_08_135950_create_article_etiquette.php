<?php

use App\Models\Article;
use App\Models\Etiquette;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_etiquette', function (Blueprint $table) {
            $table->foreignIdFor(Article::class);
            $table->foreignIdFor(Etiquette::class);
            $table->primary(['article_id', 'etiquette_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_etiquette');
    }
};
