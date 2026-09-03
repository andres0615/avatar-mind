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

        return Inertia::render('Chat/Show', [
            'characterId' => $characterId,
        ]);
    }
}