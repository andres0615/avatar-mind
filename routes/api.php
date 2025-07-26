<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CharacterApiController;
use App\Http\Controllers\Api\ChatApiController;
use App\Http\Controllers\Api\ChatMessageApiController;
use App\Http\Controllers\Api\ProfileApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas API con autenticación
Route::middleware(['auth:sanctum'])->group(function () {
    // Listar chats
    Route::get('/character', [CharacterApiController::class, 'index'])->name('api.character.index');

    // Editar personaje
    Route::get('/character/{characterId}', [CharacterApiController::class, 'show'])->name('api.character.show');

    // Crear personaje
    Route::post('/character', [CharacterApiController::class, 'store'])->name('api.character.store');
    
    // Editar personaje
    Route::put('/character/{characterId}', [CharacterApiController::class, 'update'])->name('api.character.update');
    
    // Crear chat
    // Route::post('/chat/{characterId}', [ChatApiController::class, 'store'])->name('api.chat.store');
    
    // Obtener chat 
    Route::get('/chat/{characterId}', [ChatApiController::class, 'show'])->name('api.chat.show');
    
    // Configuración de cuenta
    Route::put('/settings', [ProfileApiController::class, 'update'])->name('api.settings.update');

    // Crear mensaje de chat
    Route::post('/chat-message/{chatId}', [ChatMessageApiController::class, 'store'])->name('api.chat_message.store');

    // Route::get('/chat-message/{chatId}', [ChatMessageApiController::class, 'index'])->name('api.chat_message.index');
});