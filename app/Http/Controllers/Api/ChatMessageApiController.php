<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatMessageApiController extends Controller
{
    /**
     * Almacenar un mensaje de chat y obtener la respuesta del bot
     */
    public function store(Request $request, $chatId)
    {
        // Validar los datos del request
        $request->validate([
            'message' => 'required|string|max:65535',
        ]);

        $chatMessageModel = new ChatMessage();

        // Almacenar el mensaje del usuario y obtener la respuesta del bot
        $responseData = $chatMessageModel->storeUserMessage($chatId, $request->all());

        return response()->json($responseData, 201);
    }
}
