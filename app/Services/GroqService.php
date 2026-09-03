<?php

namespace App\Services;

use App\Models\Chat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use Prism\Prism\Prism;
use Prism\Prism\Enums\Provider;
use Illuminate\Support\Facades\Log;
use App\Models\ChatMessage;
use Prism\Prism\ValueObjects\Messages\UserMessage;
use Prism\Prism\ValueObjects\Messages\AssistantMessage;
use Prism\Prism\ValueObjects\Messages\SystemMessage;
use Illuminate\Support\Collection;

class GroqService
{
    /**
     * El modelo que maneja este servicio
     */
    protected $chatModel;

    /**
     * Constructor del servicio
     */
    public function __construct(Chat $chatModel)
    {
        $this->chatModel = $chatModel;
    }

    /**
     * Enviar mensaje del usuario al modelo y generar respuesta del bot
     * 
     * @param ChatMessage $userMessage El mensaje del usuario
     * @return string La respuesta del bot
     */
    public function generateBotResponse(ChatMessage $userMessage)
    {
        // Obtener el chat del mensaje
        $chat = $userMessage->chat;

        // Obtener el personaje del chat
        $character = $chat->character;
        // $maxTokens = $character->max_tokens + 50; // Añadir un margen de seguridad de 50 tokens
        $maxTokens = 1000;

        /** @var Collection $chatMessages Collection de todos los mensajes del chat */
        $chatMessages = $chat->messages;

        // Mapear los mensajes a objetos Message de Prism dependiendo del tipo de mensaje
        // Requerido por la librería Prism para pasar los mensajes como contexto al bot
        $chatMessages = $chatMessages->map(function ($message) {
            switch ($message->type) {
                case 'system':
                    return new SystemMessage($message->message);
                    break;

                // Respuesta del bot
                case 'assistant':
                    return new AssistantMessage($message->message);
                    break;

                // Mensaje del usuario
                case 'user':
                    return new UserMessage($message->message);
                    break;
                
                default:
                    return new SystemMessage($message->message);
                    break;
            }

        });

        // Convertir la collection a array
        $chatMessages = $chatMessages->toArray();

        Log::info('$chatMessages');
        Log::info($chatMessages);

        // Enviar el mensaje al bot y capturar la respuesta
        $botResponse = Prism::text()
            ->using(Provider::Groq, env('GROQ_MODEL')) // Usar el modelo de Groq configurado en el .env
            ->withMessages($chatMessages) // Pasar los mensajes del chat como contexto
            ->withMaxTokens($maxTokens) // Establecer el límite de tokens
            ->usingTemperature($character->temperature) // Usar la temperatura del personaje configurada
            ->asText() // Generar la respuesta como texto
            ->text; // Obtener el texto de la respuesta

        Log::info('$botResponse: ');
        Log::info($botResponse);

        return $botResponse;
    }
    
}