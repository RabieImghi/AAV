<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoiteurController extends Controller
{
    public function getAllVoiteurs()
    {
        return response()->json(Voiteur::all());
    }
}
