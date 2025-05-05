<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\buttoncontroller;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\sidebarcontroller;
use App\Http\Controllers\TontineController;

use App\Http\Controllers\TirageController;
use Illuminate\Support\Facades\Route;


//Incription utilisateur
Route::get('/register',[InscriptionController::class, 'index'])->name('Inscription_index');
Route::post('/validate-register',[InscriptionController::class, 'register'])->name('Inscription_register');
Route::get('/connexion',[Authcontroller::class, 'create'])->name('auth.create');
Route::post('/connexion',[AuthController::class, 'auth'])->name('auth.store');
Route::get('/forgot',[AuthController::class, 'forgot'])->name('forgot.password');
Route::post('/forgot',[AuthController::class, 'create'])->name('password.reset');
//Pagination entre les pages

Route::get('/creerTontine',[sidebarcontroller::class, 'button'])->name('tontine.create');
Route::get('/cards',[sidebarcontroller::class, 'cards'])->name('cards');
Route::get('/tirages',[sidebarcontroller::class, 'tirages'])->name('tirages');
Route::get('/border',[sidebarcontroller::class, 'border'])->name('border');
Route::get('/animation',[sidebarcontroller::class, 'animation'])->name('animation');
Route::get('/other',[sidebarcontroller::class, 'other'])->name('other');
Route::get('/404',[sidebarcontroller::class, 'Notfound'])->name('404');
Route::get('/dashboard',[sidebarcontroller::class, 'Dashboard'])->name('dashboard');
Route::get('/charts',[sidebarcontroller::class, 'charts'])->name('charts');
Route::get('/tables',[sidebarcontroller::class, 'tables'])->name('tables');

Route::get('/Tontines', [TontineController::class, 'index'])->name('Tontines');
Route::get('/HistoriqueTontines', [TontineController::class, 'historiqueTontine'])->name('HistoriqueTontines');



Route::post('/tontines/{id}/retirer', [TontineController::class, 'seRetirer'])->name('tontines_seRetirer');

Route::get('/tontines/{id}/paiement', [CotisationController::class, 'paiement'])->name('tontines_cotisation');


Route::post('/paiement/{id}/process', [CotisationController::class, 'processPaiement'])->name('cotisation.process');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Route::get('/tontinesparticipant', [TontineController::class, 'participer'])->name('participation_valide');


Route::get('/mestontines', [TontineController::class, 'mesTontines'])->name('mestontines');



Route::group(['middleware' => ['isAdmin']], function () {
    Route::get('/dashboard', [Authcontroller::class, 'dashboard'])->name('dashboard');

});
Route::group(['middleware' => ['isUser']], function () {
    Route::get('/home', [InscriptionController::class , 'home'])->name('home');
    Route::post('/tontines/{id}/participer', [TontineController::class, 'participer'])->name('tontines_participer');

});


// Routes pour les tontines
Route::get('/listerlestontines', [TontineController::class, 'indexe'])->name('listerlesTontines'); // Afficher la liste des tontines
Route::get('/tontines/create', [TontineController::class, 'create'])->name('page.boards.createTontine'); // Afficher le formulaire de création
Route::post('/tontines', [TontineController::class, 'store'])->name('tontines.store'); // Enregistrer une nouvelle tontine
Route::delete('/tontines/{id}', [TontineController::class, 'destroy'])->name('tontines.destroy'); // Supprimer une tontine
Route::get('/suptontines', [TontineController::class, 'listTontines'])->name('page.boards.listerlesTontines');
Route::get('/participants', [TontineController::class, 'participants'])->name('tontines.participants');
Route::get('/tontines/historique', [TontineController::class, 'historique'])->name('tontines.historique');

//Route pour modifier tontine
Route::get('/tontines/modifier', [TontineController::class, 'modifier'])->name('tontines.modifier');
Route::get('/tontines/{id}/edit', [TontineController::class, 'edit'])->name('tontines.edit');
Route::put('/tontines/{id}', [TontineController::class, 'update'])->name('tontines.update');

// Route pour afficher les détails d'une tontine
Route::get('/tontinesconsulter', [TontineController::class, 'consulter'])->name('tontines.consulter');
Route::get('/tontines/{id}', [TontineController::class, 'show'])->name('tontines.show');

// Routes pour les tirages
Route::get('/tirages', [TirageController::class, 'index'])->name('tirage.index');
Route::post('/tirages/{id}/tirer', [TirageController::class, 'tirer'])->name('tirage.tirer');

Route::get('/user/{id}/details', [ParticipantController::class, 'details'])->name('userdetails');
Route::get('/participants', [ParticipantController::class, 'showParticipants'])->name('participants');
Route::put('/tontines/{id}', [TontineController::class, 'updateTontine'])->name('tontines.update');


Route::get('/search', [CotisationController::class, 'search'])->name('search');
Route::get('/mes-transactions', [CotisationController::class, 'mesTransactions'])->name('mestransactions');
