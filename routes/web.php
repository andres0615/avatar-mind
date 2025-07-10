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

    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rutas para personajes
// Route::middleware(['auth', 'verified'])->group(function () {
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Crear personaje
    Route::get('/character/create', [CharacterController::class, 'create'])->name('character.create');
    // Route::post('/character', [CharacterController::class, 'store'])->name('character.store');
    
    // Editar personaje
    Route::get('/character/{characterId}/edit', [CharacterController::class, 'edit'])->name('character.edit');
    // Route::put('/character/{characterId}', [CharacterController::class, 'update'])->name('character.update');
    
    // Chatear con personaje
    Route::get('/chat/{characterId}', [ChatController::class, 'show'])->name('chat.show');
    // Route::post('/chat/{characterId}/message', [ChatController::class, 'sendMessage'])->name('chat.message');
    
    // Configuración de cuenta
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    // Route::put('/settings', [ProfileController::class, 'update'])->name('settings.update');
});