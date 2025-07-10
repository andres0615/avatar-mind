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
}