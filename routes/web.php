<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaAdminController;
use App\Http\Controllers\EventoAdminController;

use App\Http\Controllers\EventoUsuarioController;
use App\Http\Controllers\MercadoPagoController;

// Ruta para mostrar el formulario de pago
Route::get('/pagar', function () {
    return view('mercado_pago'); // Asegúrate de que esta vista exista
});

// Ruta para crear la preferencia de pago (POST)
Route::post('/crear-preferencia', [MercadoPagoController::class, 'createPreference'])->name('crear-preferencia');

// Rutas para manejar respuestas de Mercado Pago
Route::get('/pago-exitoso', function () {
    return 'Pago exitoso'; // Personaliza esta vista
});

Route::get('/pago-fallido', function () {
    return 'Pago fallido'; // Personaliza esta vista
});

Route::get('/pago-pendiente', function () {
    return 'Pago pendiente'; // Personaliza esta vista
});

// Página de inicio y detalles de eventos (Acceso público)
Route::get('/', [EventoAdminController::class,'index'])->name('home');
Route::post('/Eventos/{Evento}', [EventoAdminController::class, 'show'])->name('evento.show');

Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/AdminEvento/create', [EventoAdminController::class, 'create'])->name('evento.create');
    Route::post('/AdminEvento/store', [EventoAdminController::class, 'store'])->name('evento.store');
    Route::get('/AdminEvento/edit/{id}', [EventoAdminController::class,'edit'])->name('evento.edit');
    Route::put('/AdminEvento/update/{id}', [EventoAdminController::class, 'update'])->name('evento.update');
    Route::delete('/AdminEvento/destroy/{id}',[EventoAdminController::class, 'destroy'])->name('evento.destroy');
    Route::post('/AdminEvento/finalizar/{id}',[EventoAdminController::class, 'finalizar'])->name('evento.finalizar');
});


Route::middleware(['auth','can:admin-access'])->group(function(){
    Route::get('/AdminEntrada/create/{id?}',[EntradaAdminController::class, 'create'])->name('entrada.create');
    Route::post('/AdminEntrada/store/{id}', [EntradaAdminController::class,'store'])->name('entrada.store');
    Route::get('/AdminEntrada/Edit/{id}',[EntradaAdminController::class,'edit'])->name('entrada.edit');
    Route::delete('/AdminEntrada/Destroy/{id}',[EntradaAdminController::class,'destroy'])->name('entrada.destroy');
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
