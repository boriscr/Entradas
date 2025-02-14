<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaAdminController;
use App\Http\Controllers\EventoAdminController;

use App\Http\Controllers\EventoUsuarioController;

Route::get('/', [EventoAdminController::class,'index'])->name('home');
Route::resource('AdminEvento',EventoAdminController::class);

Route::resource('AdminEntradas', EntradaAdminController::class);
Route::get('Consulta/{id}/', [EntradaAdminController::class,'indexentradas'])->name('indexentradas');
Route::resource('User',EventoUsuarioController::class);

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
