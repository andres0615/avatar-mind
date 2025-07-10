<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;

class CharacterApiController extends Controller
{
    /**
     * Almacenar un nuevo personaje
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'personality' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $character = Character::create([
            'name' => $request->name,
            'description' => $request->description,
            'personality' => $request->personality,
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('avatar')) {
            $character->avatar = $request->file('avatar')->store('avatars', 'public');
            $character->save();
        }

        return redirect()->route('dashboard')->with('success', 'Personaje creado exitosamente');
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
