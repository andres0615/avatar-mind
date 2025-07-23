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

    public function generateBotResponse(ChatMessage $userMessage)
    {
        $prompt = $userMessage->message;

        $chat = $userMessage->chat;

        $character = $chat->character;
        $maxTokens = $character->max_tokens + 50; // Añadir un margen de seguridad de 50 tokens

        $systemConfigMessage = new SystemMessage($character->config_prompt);

        /** @var Collection $chatMessages */
        $chatMessages = $chat->messages;        

        // hacer un map de la variable $chatMessages
        $chatMessages = $chatMessages->map(function ($message) {
            if($message->bot_response){
                return new AssistantMessage($message->message);
            } else {
                return new UserMessage($message->message);
            }
        })
        ->unshift($systemConfigMessage)
        ->toArray();

        Log::info('$chatMessages');
        Log::info($chatMessages);

        // Aquí puedes implementar la lógica para generar una respuesta del bot
        // Por ejemplo, usando una API de IA o lógica personalizada

        // $botResponse = "Hola ya recibi tu mensaje"; // Placeholder

        // Via the third parameter of `using()`
        $botResponse = Prism::text()
            ->using(Provider::Groq, 'meta-llama/llama-4-maverick-17b-128e-instruct')
            // ->withPrompt($prompt)
            ->withMessages($chatMessages)
            ->withMaxTokens($maxTokens)
            ->usingTemperature($character->temperature)
            ->asText()
            ->text;

        Log::info('$botResponse: ');
        // Log::info(dump($botResponse->text));
        Log::info($botResponse);

        return $botResponse;
    }
    
}