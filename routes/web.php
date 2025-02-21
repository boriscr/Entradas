<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaAdminController;
use App\Http\Controllers\EventoAdminController;

use App\Http\Controllers\EventoUsuarioController;

// Página de inicio y detalles de eventos (Acceso público)
Route::get('/', [EventoAdminController::class,'index'])->name('home');
Route::get('/Eventos/{Evento}', [EventoAdminController::class, 'show'])->name('Eventos.show');

Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/AdminEvento/create', [EventoAdminController::class, 'create'])->name('evento.create');
    Route::post('/AdminEvento/store', [EventoAdminController::class, 'store'])->name('evento.store');
    Route::get('/AdminEvento/edit/{id}', [EventoAdminController::class,'edit'])->name('evento.edit');
    Route::put('/AdminEvento/update/{id}', [EventoAdminController::class, 'update'])->name('evento.update');
    Route::delete('/AdminEvento/destroy/{id}',[EventoAdminController::class, 'destroy'])->name('evento.destroy');
    Route::post('/AdminEvento/finalizar/{id}',[EventoAdminController::class, 'finalizar'])->name('evento.finalizar');
});


//Route::resource('Entradas', EntradaAdminController::class);

Route::middleware(['auth','can:admin-access'])->group(function(){
    Route::get('AdminEntrada/create/{id?}',[EntradaAdminController::class, 'create'])->name('entrada.create');
    Route::post('AdminEntrada/store', [EntradaAdminController::class,'store'])->name('entrada.store');
});

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
