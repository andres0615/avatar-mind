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

        // Generar un prompt de configuración basado en los atributos del personaje
        $configPrompt = view('prompts.character-config-prompt', compact('character'))->render();
        
        // Limpiar espacios en blanco extra y líneas vacías
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

    public function destroy($characterId)
    {
        $character = $this->characterModel->findOrFail($characterId);
        $character->delete();

        $responseData = [
            'success' => true,
            'message' => 'Personaje eliminado exitosamente',
            'data' => []
        ];

        return $responseData;
    }
}