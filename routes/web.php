<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\buttoncontroller;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\sidebarcontroller;
use Illuminate\Support\Facades\Route;


//Incription utilisateur
Route::get('/register',[InscriptionController::class, 'index'])->name('Inscription_index');
Route::post('/validate-register',[InscriptionController::class, 'register'])->name('Inscription_register');
Route::get('/connexion',[Authcontroller::class, 'create'])->name('auth.create');
Route::post('/connexion',[AuthController::class, 'auth'])->name('auth.store');
Route::get('/forgot',[AuthController::class, 'forgot'])->name('forgot.password');
Route::post('/forgot',[AuthController::class, 'create'])->name('password.reset');
//Pagination entre les pages

Route::get('/button',[sidebarcontroller::class, 'button'])->name('button');
Route::get('/cards',[sidebarcontroller::class, 'cards'])->name('cards');
Route::get('/colors',[sidebarcontroller::class, 'colors'])->name('colors');
Route::get('/border',[sidebarcontroller::class, 'border'])->name('border');
Route::get('/animation',[sidebarcontroller::class, 'animation'])->name('animation');
Route::get('/other',[sidebarcontroller::class, 'other'])->name('other');
Route::get('/404',[sidebarcontroller::class, 'Notfound'])->name('404');
Route::get('/dashboard',[sidebarcontroller::class, 'Dashboard'])->name('dashboard');
Route::get('/charts',[sidebarcontroller::class, 'charts'])->name('charts');
Route::get('/tables',[sidebarcontroller::class, 'tables'])->name('tables');



Route::group(['middleware' => ['isAdmin']], function () {
    Route::get('/dashboard', [Authcontroller::class, 'dashboard'])->name('dashboard');

});
Route::group(['middleware' => ['isUser']], function () {
    Route::get('/home', [InscriptionController::class , 'home'])->name('home');
});
