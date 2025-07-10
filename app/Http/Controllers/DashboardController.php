<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Character;

class DashboardController extends Controller
{
    /**
     * Mostrar la página de bienvenida (dashboard)
     */
    public function index()
    {
        return Inertia::render('Dashboard');
    }
}