<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\Character;

class ChatApiController extends Controller
{

    public function store()
    {
        
    }

    /**
     * Enviar un mensaje al personaje
     */
    public function sendMessage(Request $request, Character $character)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Guardar el mensaje del usuario
        $userMessage = ChatMessage::create([
            'character_id' => $character->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'is_from_user' => true,
        ]);

        // Aquí puedes agregar la lógica para generar la respuesta del personaje
        // Por ejemplo, usando una API de IA o lógica personalizada
        $characterResponse = $this->generateCharacterResponse($character, $request->message);

        // Guardar la respuesta del personaje
        ChatMessage::create([
            'character_id' => $character->id,
            'user_id' => auth()->id(),
            'message' => $characterResponse,
            'is_from_user' => false,
        ]);

        return back();
    }

    /**
     * Generar respuesta del personaje (placeholder)
     */
    private function generateCharacterResponse(Character $character, string $userMessage)
    {
        // Aquí implementarías la lógica para generar la respuesta del personaje
        // basándose en su personalidad y el mensaje del usuario
        return "Respuesta de {$character->name}: Entiendo tu mensaje sobre '{$userMessage}'";
    }
}
