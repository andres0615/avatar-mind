<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rutas para personajes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Crear personaje
    Route::get('/character/create', [CharacterController::class, 'create'])->name('character.create');
    
    // Editar personaje
    Route::get('/character/{characterId}/edit', [CharacterController::class, 'edit'])->name('character.edit');
    
    // Chatear con personaje
    Route::get('/chat/{characterId}', [ChatController::class, 'show'])->name('chat.show');
    
    // Configuración de cuenta
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
});