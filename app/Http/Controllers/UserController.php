<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function storeUser(Request $request){
        if($request->user() && $request->user()->role_id==1){
            $user = new AuthController();
            $user->registre($request);
            return response()->json([
                'message' => 'User created successfully',
            ]);
        }
        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
        
    }
    public function updateUser(Request $request){
        if($request->user() && $request->user()->role_id==1){
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'role_id' => 'required|exists:roles,id',
                'user_id' => 'required',
            ]);
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'message' => 'User updated successfully',
            ]);
        }
        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
        
    }
    public function deleteUser(Request $request, $id){
        if($request->user() && $request->user()->role_id==1){
            $user = User::find($id);
            $user->delete();
            $user->tokens()->delete();
            return response()->json([
                'message' => 'User deleted successfully',
            ]);
        }
        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
        
    }
}
