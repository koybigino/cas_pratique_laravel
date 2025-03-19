<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Etiquette;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $ets = Etiquette::factory(30)->create();

        Article::factory(20)->hasAttached($ets->random(3))->create();
        
        Categorie::factory(10)->create();

        User::create([
            "name" => "Koybi",
            "email" => "koybi@test.com",
            "password" => Hash::make("koybi123")
        ]);
    }
        
}
