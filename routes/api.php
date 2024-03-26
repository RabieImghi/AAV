<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoiteurController;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/createUser', [AuthController::class, 'registre']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/voiteurs', [VoiteurController::class, 'getAllVoiteurs']);
    Route::post('/insertUser', [UserController::class, 'storeUser']);
    Route::post('/updateUser', [UserController::class, 'updateUser']);
    Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser']);
    Route::post('/estimation', [VoiteurController::class, 'estimation']);
});