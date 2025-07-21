<?php

namespace App\Services;

use App\Models\Character;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class CharacterService
{
    /**
     * El modelo que maneja este servicio
     */
    protected $characterModel;

    /**
     * Constructor del servicio
     */
    public function __construct(Character $characterModel)
    {
        $this->characterModel = $characterModel;
    }
}