<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\Api\FournisseurController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);



Route::get('/articles', [ArticleController::class, 'index']);
Route::post('/articles', [ArticleController::class, 'store']);
Route::get('/articles/{article}', [ArticleController::class, 'show']);
Route::put('/articles/{article}', [ArticleController::class, 'update']);
Route::delete('/articles/{article}', [ArticleController::class, 'destroy']);

Route::get('/chapters', [ChapterController::class, 'index'])->middleware('can:read-chapter');
Route::post('/chapters', [ChapterController::class, 'store'])->middleware('can:create-chapter');
Route::put('/chapters/{id}', [ChapterController::class, 'update'])->middleware('can:update-chapter');
Route::delete('/chapters/{id}', [ChapterController::class, 'destroy'])->middleware('can:delete-chapter');


Route::prefix('fournisseurs')->group(function () {
    Route::get('/', [FournisseurController::class, 'index']);
    Route::post('/', [FournisseurController::class, 'store']);
    Route::get('/{id}', [FournisseurController::class, 'show'])->middleware('admin');
    Route::put('/{id}', [FournisseurController::class, 'update'])->middleware('admin');
    Route::delete('//{id}', [FournisseurController::class, 'destroy'])->middleware('admin');
});

Route::get('/structure', [StructureController::class, 'index'])->middleware('admin');
Route::post('/structure', [StructureController::class, 'store'])->middleware('admin');
Route::get('/structure/{id}', [StructureController::class, 'show'])->middleware('admin');
Route::put('/structure/{id}', [StructureController::class, 'update'])->middleware('admin');
Route::delete('/structure/{id}', [StructureController::class, 'destroy'])->middleware('admin');


Route::post('/auth/register', [UserController::class, 'createUser'])->middleware('can:create-user');
Route::post('/auth/login', [UserController::class, 'login']);


Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    Route::get("profile", [UserController::class, "profile"]);
    Route::get("logout", [UserController::class, "logout"]);
});

Route::put('/update/{id}', [UserController::class, 'update'])->middleware('can:update-user');