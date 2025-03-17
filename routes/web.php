<?php
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaAdminController;
use App\Http\Controllers\EventoAdminController;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MercadoPagoController;

// Ruta para crear la preferencia de pago
Route::post('/create-preference', [MercadoPagoController::class, 'createPaymentPreference'])->name('create-preference');

// Rutas para manejar respuestas de Mercado Pago
Route::get('/mercadopago/success', [ClienteController::class,'index'])->name('mercadopago.success');

Route::get('/mercadopago/failed', function () {
    return 'Pago fallido'; // Personaliza esta vista
})->name('mercadopago.failed');


// Página de inicio y detalles de eventos (Acceso público)
Route::get('/', [EventoAdminController::class,'index'])->name('home');
Route::get('/Eventos/{Evento}', [EventoAdminController::class, 'show'])->name('evento.show');

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


Route::middleware('auth')->group(function(){
    Route::get('/AdminEntrada/show/{id?}',[EntradaAdminController::class, 'show'])->name('entrada.show');
    Route::get('verEntrada/',[ClienteController::class,'index'])->name('entrada.index');
});
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
