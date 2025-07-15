<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CharacterApiController;
use App\Http\Controllers\Api\ChatApiController;
use App\Http\Controllers\Api\ProfileApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas API con autenticación
Route::middleware(['auth:sanctum'])->group(function () {
    // Crear personaje
    Route::post('/character', [CharacterApiController::class, 'store'])->name('api.character.store');
    
    // Editar personaje
    Route::put('/character/{characterId}', [CharacterApiController::class, 'update'])->name('api.character.update');
    
    // Crear chat
    Route::post('/chat/{characterId}', [ChatApiController::class, 'store'])->name('api.chat.store');
    
    // Configuración de cuenta
    Route::put('/settings', [ProfileApiController::class, 'update'])->name('api.settings.update');
});