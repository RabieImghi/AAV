<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiteur;

class VoiteurController extends Controller
{
   public function getAllVoiteurs(Request $request)
{
    $token = $request->bearerToken();
    if($request->user()){
        $voiteurs = Voiteur::all();
        return response()->json($voiteurs);
    }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    return response()->json(['message' => 'Unauthorized'], 401);
}
}
