<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Character;

class CharacterController extends Controller
{
    /**
     * Mostrar el formulario para crear un nuevo personaje
     */
    public function create()
    {
        return Inertia::render('Character/Create');
    }

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
     * Mostrar el formulario para editar un personaje
     */
    public function edit(/*Character $character*/)
    {
        // Verificar que el usuario sea el propietario del personaje
        // if ($character->user_id !== auth()->id()) {
        //     abort(403);
        // }

        return Inertia::render('Character/Edit'/*, [
            'character' => $character
        ]*/);
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