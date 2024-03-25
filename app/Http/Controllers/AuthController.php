<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registre(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'role_id' => 'required|exists:roles,id'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        return response()->json([
            'message' => 'User created successfully',
        ]);
        
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json([
            'token' => $token
        ]);
    }
}
