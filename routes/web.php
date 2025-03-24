<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EtiquetteController;
use App\Http\Controllers\ProfileController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('article', ArticleController::class);
Route::resource('categorie', CategorieController::class);
Route::resource('etiquette', EtiquetteController::class);


// Route::get("/me/login", [AuthController::class, "login"])->name("auth.login")->middleware('guest');
// Route::get("/me/logout", [AuthController::class, "logout"])->name("auth.logout")->middleware('auth');
// Route::post("/me/login", [AuthController::class, "seLoger"]);

Route::get("/contact", [ContactController::class, 'contact'])->name('contact')->can('envoyer', Contact::class);
Route::post("/contact", [ContactController::class, 'envoyer'])->can('envoyer', Contact::class);


require __DIR__ . '/auth.php';
