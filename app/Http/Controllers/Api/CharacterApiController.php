<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;
use App\Http\Requests\StoreCharacterRequest;
use Illuminate\Http\JsonResponse;

class CharacterApiController extends Controller
{
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

            return response()->json([
                'success' => true,
                'message' => 'Personaje creado exitosamente',
                'data' => $character->load('user'),
            ], 201);

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
    public function update(Request $request, Character $character)
    {
        // Verificar que el usuario sea el propietario del personaje
        if ($character->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'personality' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $character->update([
            'name' => $request->name,
            'description' => $request->description,
            'personality' => $request->personality,
        ]);

        if ($request->hasFile('avatar')) {
            $character->avatar = $request->file('avatar')->store('avatars', 'public');
            $character->save();
        }

        return redirect()->route('dashboard')->with('success', 'Personaje actualizado exitosamente');
    }
}
