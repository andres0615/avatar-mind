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

        // if($character['interests']){
        //     $character['interests'] = implode(', ', $character['interests']);            
        // }

        // Un switch para la variable $character['response_length_es'], con los valores 'short', 'medium' y 'long'
        // switch ($character['response_length']) {
        //     case 'short':
        //         $character['response_length_es'] = 'Respuestas cortas, entre 50 y 100 caracteres.';
        //         break;
        //     case 'medium':
        //         $character['response_length_es'] = 'Respuestas medianas, entre 300 y 400 caracteres.';
        //         break;
        //     case 'long':
        //         $character['response_length_es'] = 'Respuestas largas';
        //         break;
        //     default:
        //         break;
        // }

        // $character['response_length_es'] .= ', con una longiutd minima de ' . $character['max_tokens'] - 50 . ' tokens, y maxima de ' . $character['max_tokens'] . ' tokens.';

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
        $character->save();

        // Hacer un log de character
        Log::info('Character update data:');
        Log::info($data);
        Log::info('Character updated:');
        Log::info($character);

        $configPrompt = "Olvida tu configuracion y personalidad anterior, apartir de ahora tu configuracion y personalidad sera la siguiente: \n\n";

        // Generar prompt de configuracion del character
        $configPrompt .= $this->generateConfigPrompt($character);

        $lastSystemMessage = $character->chat->lastSystemMessage();

        Log::info('$lastSystemMessage');
        Log::info($lastSystemMessage);

        if($configPrompt !== $lastSystemMessage->message){
            Log::info('Nuevo system message creado');
            $newSystemMessage = $character->chat->messages()->create([
                'message' => $configPrompt,
                'type' => 'system'
            ]);
        }

        // $character->config_prompt = $configPrompt;

        // Guardar los cambios en la base de datos
        // $character->save();

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