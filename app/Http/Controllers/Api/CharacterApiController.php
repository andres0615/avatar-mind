<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;
use App\Http\Requests\StoreCharacterRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Services\CharacterService;
use App\Models\User;
use Illuminate\Support\Collection;

class CharacterApiController extends Controller
{
    protected $characterService;

    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    public function index()
    {
        // Aquí iría la lógica para listar los chats del usuario autenticado
        // Por ejemplo, obtener todos los chats asociados al usuario autenticado

        /** @var User $user */
        $user = auth()->user();

        /** @var Collection $characters */
        $characters = $user
                    ->characters()
                    ->with('chat.lastMessage')
                    ->get();

        $characters = $characters->sortByDesc('chat.updated_at')->values();

        $responseData = [
            'success' => true,
            'message' => 'Chats retrieved successfully',
            'data' => [
                'characters' => $characters,
            ], // Cargar la relación character si es necesario
        ];

        return response()->json($responseData, 200);
    }

    /**
     * Almacenar un nuevo personaje
     */
    public function store(StoreCharacterRequest $request)
    {
        try {
            $character = Character::create([
                'name' => $request->name,
                'category' => $request->category,
                'tagline' => $request->tagline,
                'visibility' => $request->visibility ?? 'public',
                'personality_description' => $request->personality_description,
                'age' => $request->age,
                'occupation' => $request->occupation,
                'interests' => $request->interests,
                'creativity_level' => $request->creativity_level ?? 7,
                'response_length' => $request->response_length ?? 'medium',
                'user_id' => auth()->id(),
            ]);

            // Crear un chat asociado al personaje
            $chat = $character->chat()->create();

            // Generar prompt de configuracion del character
            $configPrompt = $this->characterService->generateConfigPrompt($character);

            // $character->config_prompt = $configPrompt;
            // $character->save();

            $chatMessageConfig = $chat->messages()->create([
                'message' => $configPrompt,
                'type' => 'system'
            ]);

            $chatMessageAssistant = $chat->messages()->create([
                'message' => "Hola, soy {$character->name}. ¿Cómo puedo ayudarte hoy?",
                'type' => 'assistant'
            ]);

            $responseData = [
                'success' => true,
                'message' => 'Personaje creado exitosamente',
                'data' => [
                    'character' => $character->load('user'),
                    'chat' => $chat, // Incluir el chat creado
                ]
            ];

            return response()->json($responseData, 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el personaje',
                'error' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor',
            ], 500);
        }
    }

    /**
     * Actualizar un personaje existente
     */
    public function update(StoreCharacterRequest $request, $characterId)
    {
        try {
            $responseData = $this->characterService->update($characterId, $request->validated());

            return response()->json($responseData, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el personaje',
                'error' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor',
            ], 500);
        }

        // Verificar que el usuario sea el propietario del personaje
        // if ($character->user_id !== auth()->id()) {
        //     abort(403);
        // }

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'personality' => 'required|string',
        //     'avatar' => 'nullable|image|max:2048',
        // ]);

        // $character->update([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'personality' => $request->personality,
        // ]);

        // if ($request->hasFile('avatar')) {
        //     $character->avatar = $request->file('avatar')->store('avatars', 'public');
        //     $character->save();
        // }

        // return redirect()->route('dashboard')->with('success', 'Personaje actualizado exitosamente');
    }

    public function show($characterId)
    {
        try {
            $responseData = $this->characterService->show($characterId);

            return response()->json($responseData, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el personaje',
                'error' => config('app.debug') ? $th->getMessage() : 'Error interno del servidor',
            ], 500);
        }
    }
}
