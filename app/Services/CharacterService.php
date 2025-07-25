<?php

namespace App\Services;

use App\Models\Character;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;

class CharacterService
{
    /**
     * El modelo que maneja este servicio
     * @var Builder|Character
     */
    protected $characterModel;

    /**
     * Constructor del servicio
     */
    public function __construct(Character $characterModel)
    {
        $this->characterModel = $characterModel;
    }

    public function generateConfigPrompt(Character $character)
    {
        // Generar un prompt de configuración basado en los atributos del personaje
        $character = $character->toArray();

        Log::info('$character');
        Log::info($character);

        if($character['interests']){
            $character['interests'] = implode(', ', $character['interests']);            
        }

        // Un switch para la variable $character['response_length_es'], con los valores 'short', 'medium' y 'long'
        switch ($character['response_length']) {
            case 'short':
                $character['response_length_es'] = 'Respuestas cortas, con una longiutd maxima de ' . $character['max_tokens'] . ' tokens.';
                break;
            case 'medium':
                $character['response_length_es'] = 'Respuestas medianas, con una longiutd maxima de ' . $character['max_tokens'] . ' tokens.';
                break;
            case 'long':
                $character['response_length_es'] = 'Respuestas largas, con una longiutd maxima de ' . $character['max_tokens'] . ' tokens.';
                break;
            default:
                break;
        }

        // Generar un prompt de configuración basado en los atributos del personaje
        $configPrompt = view('prompts.character-config-prompt', compact('character'))->render();
        
        // Limpiar espacios en blanco extra y líneas vacías
        // $configPrompt = preg_replace('/\n\s*\n\s*\n/', "\n\n", $configPrompt);
        $configPrompt = trim($configPrompt);

        // log de la variable $configPrompt
        Log::info('Generated Character Config Prompt:');
        Log::info($configPrompt);

        return $configPrompt;
    }

    public function update($characterId, array $data)
    {
        // Buscar el personaje por ID
        $character = $this->characterModel->find($characterId);

        if (!$character) {
            throw new Exception('Character not found');
        }

        // Actualizar los atributos del personaje
        $character->fill($data);

        // Guardar los cambios en la base de datos
        $character->save();

        $chat = $character->chat;

        $responseData = [
            'success' => true,
            'message' => 'Personaje actualizado exitosamente',
            'data' => [
                'character' => $character->load('user'),
                'chat' => $chat, // Incluir el chat creado
            ]
        ];

        return $responseData;
    }

    public function show($characterId)
    {
        $character = $this->characterModel->findOrFail($characterId);
        $chat = $character->chat;

        $responseData = [
            'success' => true,
            'message' => 'Personaje obtenido exitosamente',
            'data' => [
                'character' => $character->load('user'),
                'chat' => $chat, // Incluir el chat creado
            ]
        ];

        return $responseData;
    }
}