<?php

namespace App\Services;

use App\Models\Chat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use Prism\Prism\Prism;
use Prism\Prism\Enums\Provider;
use Illuminate\Support\Facades\Log;

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

    public function generateBotResponse($prompt)
    {
        // Aquí puedes implementar la lógica para generar una respuesta del bot
        // Por ejemplo, usando una API de IA o lógica personalizada

        $botResponse = "Hola ya recibi tu mensaje"; // Placeholder

        // Via the third parameter of `using()`
        $botResponse = Prism::text()
            ->using(Provider::Groq, 'meta-llama/llama-4-maverick-17b-128e-instruct')
            ->withPrompt($prompt)
            ->asText()
            ->text;

        Log::info('$botResponse: ');
        // Log::info(dump($botResponse->text));
        Log::info($botResponse);

        return $botResponse;
    }
    
}