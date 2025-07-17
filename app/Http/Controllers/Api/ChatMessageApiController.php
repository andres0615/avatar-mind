<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatMessageApiController extends Controller
{
    public function store(Request $request, $chatId)
    {
        // Aquí iría la lógica para almacenar un mensaje de chat
        // Por ejemplo, validar el request y crear un nuevo mensaje asociado al chat

        // Validar los datos del request
        $request->validate([
            'message' => 'required|string|max:65535',
        ]);

        $chatMessageModel = new ChatMessage();

        $responseData = $chatMessageModel->storeUserMessage($chatId, $request->all());

        return response()->json($responseData, 201);
    }
}
