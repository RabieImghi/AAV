<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiteur;
class VoiteurController extends Controller
{
   public function getAllVoiteurs(Request $request){
        if($request->user()){
            $voiteurs = Voiteur::all();
            return response()->json($voiteurs);
        }else{
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function estimation(Request $request){
        if($request->user()){
            $request->validate([
                "marque" => "required|string|max:255",
                "modele" => "required|string|max:255",
                "annee" => "required|integer|digits:4",
                "kilometrage" => "required|integer",
                "prix" => "required|numeric|between:0,999999.99",
                "puissance" => "required|integer",
                "motorisation" => "required|string|max:255",
                "carburant" => "required|string|max:255",
            ]);
            $minKilometrage = $request->kilometrage - 200000;
            $maxKilometrage = $request->kilometrage + 200000;
            $minPrix = $request->prix - 100000;
            $maxPrix = $request->prix + 100000;
            
            $voiteurestimation = Voiteur::where([
                ['modele', '=', $request->modele],
                ['annee', '=', $request->annee],
                ['puissance', '=', $request->puissance],
                ['motorisation', '=', $request->motorisation],
                ['carburant', '=', $request->carburant],
            ])
            ->whereBetween('kilometrage', [$minKilometrage, $maxKilometrage])
            ->whereBetween('prix', [$minPrix, $maxPrix])
            ->avg('prix');
            return response()->json($voiteurestimation);
        }
        
    }
}
