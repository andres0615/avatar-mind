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
    public function edit(int $characterId)
    {

        return Inertia::render('Character/Edit', [
            'characterId' => $characterId
        ]);
    }
}