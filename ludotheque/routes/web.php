<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeuController;
use App\Http\Controllers\ProfilController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/enonce', function () {
    return view('enonce.index');
});

Route::get('/formulaire' , function() {
    return view('formulaire');
});


//Route::middleware(['auth:sanctum', 'verified'])->resource('dashboard', 'App\Http\Controllers\Jeux\AddController');
//Route::middleware(['auth:sanctum', 'verified'])->resource('jeu.listeJeux', 'App\Http\Controllers\JeuController');
Route::middleware(['auth:sanctum', 'verified'])->resource('jeu.listeJeux', 'App\Http\Controllers\JeuController');
Route::middleware(['auth:sanctum', 'verified'])->resource('profil', 'App\Http\Controllers\ProfilController');

//page d'accueil
Route::get('/dashboard',"\App\Http\Controllers\JeuController@randomGames");

//Différentes listes des jeux (paginations + tris)
Route::get('tri', [JeuController::class, 'tri'])->name('listeJeuxTri');
Route::get('/listeJeux',"\App\Http\Controllers\JeuController@index")->name('listeJeux');
Route::get('listeJeuxPages/{nb?}', [JeuController::class, 'list'])->name('pagination');
Route::get('listeJeuxTheme/{nb?}', [JeuController::class, 'indexTheme'])->name('listeJeuxTheme');
Route::get('listeJeuxMecanique/{nb?}', [JeuController::class, 'indexMecanique'])->name('listeJeuxMecanique');

//Détails des jeux (Infos complémentaires + commentaires)
Route::get('/jeu/{id}', [JeuController::class, 'show'])->name('jeu_show');
Route::get('/jeu/{id}/tri', [JeuController::class, 'triChrono'])->name('showTri');
Route::get('/regles/{id}', [JeuController::class, 'regles'])->name('jeu_regles');
Route::get('/commentaire/{id}',[\App\Http\Controllers\CommentaireController::class, 'show'])->name('commentaire.show');
Route::get('/commentaire/delete/{id}',[\App\Http\Controllers\CommentaireController::class, 'delete'])->name('commentaire.delete');
Route::get('/meilleur',"\App\Http\Controllers\JeuController@bestGames");

//Profil + ludothèque personnelle
Route::get('/profil', [ProfilController::class,'index'])->name('profil')->middleware('auth');
Route::get('/achatjeu', [ProfilController::class,'addAchat'])->name('achatjeu')->middleware('auth');
Route::get('/supprimer/{id}', [ProfilController::class,'removeAchat'])->name('supprimerA')->middleware('auth');
Route::get('/afficheachat', [ProfilController::class,'afficheAchat'])->name('afficheachat')->middleware('auth');
Route::get('rechercher',[JeuController::class, 'search'])->name('rechercher');
//formulaires ajout jeu + commentaire + profil
Route::post('/commentaire/store',"\App\Http\Controllers\AddController@commentairestore")->name('commentaire.store')->middleware('auth');
Route::post('/profil', [ProfilController::class,'storeAchat'])->name('storeAchat')->middleware('auth');
Route::post('/formulaire', [JeuController::class, 'store'])->name('jeu_store')->middleware('auth');
