<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SetLocaleController;

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

// Route de base pour la page d'accueil
Route::get('/', function () {
    return view('home');
})->name('home');

// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    // Routes pour les étudiants
    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
    Route::get('/etudiants/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');
    Route::get('/etudiants/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
    Route::put('/etudiants/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');
    Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');

    // Routes pour les articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Routes pour les documents
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('documents.update');

    // Routes pour les villes
    Route::get('/villes', [VilleController::class, 'index'])->name('villes.index');
    Route::get('/villes/create', [VilleController::class, 'create'])->name('villes.create');
    Route::post('/villes', [VilleController::class, 'store'])->name('villes.store');
    Route::get('/villes/{ville}', [VilleController::class, 'show'])->name('villes.show');
    Route::get('/villes/{ville}/edit', [VilleController::class, 'edit'])->name('villes.edit');
    Route::put('/villes/{ville}', [VilleController::class, 'update'])->name('villes.update');
    Route::delete('/villes/{ville}', [VilleController::class, 'destroy'])->name('villes.destroy');

    // Routes pour les utilisateurs
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/edit/user/{user}', [UserController::class, 'edit'])->name('user.edit');
});

// Routes d'inscription pour les étudiants
Route::get('/inscription', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/inscription', [EtudiantController::class, 'store'])->name('etudiants.store');

// Route pour télécharger les documents
Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

// Route pour changer la langue
Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');

// Routes d'authentification
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

// Routes ressources génériques pour les documents et utilisateurs
Route::resource('documents', DocumentController::class);

Route::resource('user', UserController::class); // Semble redondant, considérer la suppression ou la clarification de l'usage
