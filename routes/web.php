<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\sidebarcontroller;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\TirageController;

// ---------------------- AuthController ----------------------
Route::get('/', [Authcontroller::class, 'create'])->name('auth.create');
Route::post('/connexion', [AuthController::class, 'auth'])->name('auth.store');
Route::get('/forgot', [AuthController::class, 'forgot'])->name('forgot.password');
Route::post('/forgot', [AuthController::class, 'create'])->name('password.reset');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', [Authcontroller::class, 'dashboard'])->name('dashboard');
});

// ---------------------- InscriptionController ----------------------
Route::get('/register', [InscriptionController::class, 'index'])->name('Inscription_index');
Route::post('/validate-register', [InscriptionController::class, 'register'])->name('Inscription_register');

Route::middleware(['isUser'])->group(function () {
    Route::get('/home', [InscriptionController::class , 'home'])->name('home');
});

// ---------------------- SidebarController ----------------------
Route::get('/creerTontine', [sidebarcontroller::class, 'button'])->name('tontine.create');
Route::get('/cards', [sidebarcontroller::class, 'cards'])->name('cards');
Route::get('/tirages', [sidebarcontroller::class, 'tirages'])->name('tirages');
Route::get('/border', [sidebarcontroller::class, 'border'])->name('border');
Route::get('/animation', [sidebarcontroller::class, 'animation'])->name('animation');
Route::get('/other', [sidebarcontroller::class, 'other'])->name('other');
Route::get('/404', [sidebarcontroller::class, 'Notfound'])->name('404');
Route::get('/dashboard', [sidebarcontroller::class, 'Dashboard'])->name('dashboard');
Route::get('/charts', [sidebarcontroller::class, 'charts'])->name('charts');
Route::get('/tables', [sidebarcontroller::class, 'tables'])->name('tables');

// ---------------------- TontineController ----------------------
Route::get('/Tontines', [TontineController::class, 'index'])->name('Tontines');
Route::get('/HistoriqueTontines', [TontineController::class, 'historiqueTontine'])->name('HistoriqueTontines');
Route::get('/listerlestontines', [TontineController::class, 'indexe'])->name('listerlesTontines');
Route::get('/tontines/create', [TontineController::class, 'create'])->name('page.boards.createTontine');
Route::post('/tontines', [TontineController::class, 'store'])->middleware('auth')->name('tontines.store');
Route::delete('/tontines/{id}', [TontineController::class, 'destroy'])->name('tontines.destroy');
Route::get('/suptontines', [TontineController::class, 'listTontines'])->name('page.boards.listerlesTontines');
Route::get('/participants', [TontineController::class, 'participants'])->name('tontines.participants');
Route::get('/tontines/historique', [TontineController::class, 'historique'])->name('tontines.historique');
Route::get('/tontines/modifier', [TontineController::class, 'modifier'])->name('tontines.modifier');
Route::get('/tontines/{id}/edit', [TontineController::class, 'edit'])->name('tontines.edit');
Route::put('/tontines/{id}', [TontineController::class, 'update'])->name('tontines.update');
Route::put('/tontines/{id}', [TontineController::class, 'updateTontine'])->name('tontines.update'); // doublon, attention !
Route::get('/tontinesconsulter', [TontineController::class, 'consulter'])->name('tontines.consulter');
Route::get('/tontines/{id}', [TontineController::class, 'show'])->name('tontines.show');
Route::post('/tontines/{id}/retirer', [TontineController::class, 'seRetirer'])->name('tontines_seRetirer');
Route::get('/mestontines', [TontineController::class, 'mesTontines'])->name('mestontines');
// Route pour générer des cotisations pour une tontine
Route::post('/tontines/{id}/generate-cotisations', [TontineController::class, 'generateCotisationsForTontine'])->name('tontines.generateCotisations');

// Route pour afficher l'historique des cotisations d'un participant
Route::get('/participant/{id}/cotisations', [ParticipantController::class, 'showCotisations'])->name('participant.cotisations');


Route::middleware(['isUser'])->group(function () {
    Route::post('/tontines/{id}/participer', [TontineController::class, 'participer'])->name('tontines_participer');
});

// ---------------------- ParticipantController ----------------------
Route::get('/user/{id}/details', [ParticipantController::class, 'details'])->name('userdetails');
Route::get('/participants', [ParticipantController::class, 'showParticipants'])->name('participants');

// ---------------------- CotisationController ----------------------
Route::get('/tontines/{id}/paiement', [CotisationController::class, 'paiement'])->name('tontines_cotisation');
Route::post('/paiement/{id}/process', [CotisationController::class, 'processPaiement'])->name('cotisation.process');
Route::get('/search', [CotisationController::class, 'search'])->name('search');
Route::get('/mes-transactions', [CotisationController::class, 'mesTransactions'])->name('mestransactions');

// ---------------------- DemandeController ----------------------
Route::get('/gerant/demandes', [DemandeController::class, 'indexDemande'])->name('gerant.demandes');

// ---------------------- TirageController ----------------------
Route::get('/tirages', [TirageController::class, 'index'])->name('tirage.index');
Route::post('/tirages/{id}/tirer', [TirageController::class, 'tirer'])->name('tirage.tirer');
