<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiteur;

class VoiteurController extends Controller
{
    public function getAllVoiteurs()
    {
        return response()->json(Voiteur::all());
    }
}
