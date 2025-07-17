<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Character;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    /**
     * Mostrar la interfaz de chat con un personaje
     */
    public function show(Request $request, int $characterId)
    {
        // Cargar los mensajes del chat para este personaje y usuario
        // $messages = ChatMessage::where('character_id', $character->id)
        //     ->where('user_id', auth()->id())
        //     ->orderBy('created_at', 'asc')
        //     ->get();

        return Inertia::render('Chat/Show', [
            'characterId' => $characterId,
        ]);
    }
}