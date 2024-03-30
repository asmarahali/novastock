<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\Api\FournisseurController;

Route::prefix('fournisseurs')->group(function () {
    Route::get('/', [FournisseurController::class, 'index']);
    Route::post('/', [FournisseurController::class, 'store']);
    Route::get('/{id}', [FournisseurController::class, 'show']);
    Route::put('/{id}', [FournisseurController::class, 'update']);
    Route::delete('//{id}', [FournisseurController::class, 'destroy']);
});

Route::get('/structure', [StructureController::class, 'index']);
Route::post('/structure', [StructureController::class, 'store']);
Route::get('/structure/{id}', [StructureController::class, 'show']);
Route::put('/structure/{id}', [StructureController::class, 'update']);
Route::delete('/structure/{id}', [StructureController::class, 'destroy']);


Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'login']);


Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    Route::get("profile", [UserController::class, "profile"]);
    Route::get("logout", [UserController::class, "logout"]);
});

Route::put('/update/{id}', [UserController::class, 'update']);