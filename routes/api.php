<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\Api\FournisseurController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ChapterArticleController;
use App\Http\Controllers\Api\ChapterArticleProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RoleController;
use App\Models\Role;
use App\Http\Controllers\Api\ParamètreController;
use App\Http\Controllers\Api\QuantitéCommandController;

Route::get('/products', [ProductController::class, 'index'])->middleware('is_able:read-product');
Route::post('/products', [ProductController::class, 'store'])->middleware('is_able:create-product');
Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('is_able:show-product');
Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('is_able:update-product');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('is_able:delete-product');



Route::get('/articles', [ArticleController::class, 'index'])->middleware('is_able:read-article');
Route::post('/articles', [ArticleController::class, 'store'])->middleware('is_able:create-article');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->middleware('is_able:show-article');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->middleware('is_able:update-article');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->middleware('is_able:delete-article');

Route::get('/chapters', [ChapterController::class, 'index'])->middleware('is_able:read-chapter');
Route::post('/chapters', [ChapterController::class, 'store'])->middleware('is_able:create-chapter');
Route::put('/chapters/{id}', [ChapterController::class, 'update'])->middleware('is_able:update-chapter');
Route::delete('/chapters/{id}', [ChapterController::class, 'destroy'])->middleware('is_able:delete-chapter');


Route::prefix('fournisseurs')->group(function () {
    Route::get('/', [FournisseurController::class, 'index'])->middleware('is_able:read-fournisseur');
    Route::post('/', [FournisseurController::class, 'store'])->middleware('is_able:create-fournisseur');
    Route::get('/{id}', [FournisseurController::class, 'show'])->middleware('is_able:show-fournisseur');
    Route::put('/{id}', [FournisseurController::class, 'update'])->middleware('is_able:update-fournisseur');
    Route::delete('//{id}', [FournisseurController::class, 'destroy'])->middleware('is_able:delete-fournisseur');
});

Route::post('/auth/register', [UserController::class, 'createUser']);//->middleware('is_able:create-user');
Route::post('/auth/login', [UserController::class, 'login'])->name('login');


Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    Route::get("profile", [UserController::class, "profile"]);
    Route::get("logout", [UserController::class, "logout"]);
});

Route::put('/update/{id}', [UserController::class, 'update']);




Route::get('/roles', function(){
  return response()->json(Role::select('id', 'name')->get());
    
});
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/{id}', [RoleController::class, 'show']);
Route::post('/roles', [RoleController::class, 'store']);
Route::put('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);


Route::get('/paramètres', [ParamètreController::class, 'index'])->middleware('is_able:read-paramaters');
Route::post('/paramètres', [ParamètreController::class, 'store'])->middleware('is_able:create-paramaters');
Route::get('/paramètres/{paramètre}', [ParamètreController::class, 'show'])->middleware('is_able:show-paramaters');
Route::put('/paramètres/{paramètre}', [ParamètreController::class, 'update'])->middleware('is_able:update-paramaters');
Route::delete('/paramètres/{paramètre}', [ParamètreController::class, 'destroy'])->middleware('is_able:delete-paramaters');

// pour le bon de commande 

Route::prefix('chapters')->group(function () {
    Route::get('/', [ChapterController::class, 'index']);
    Route::get('/{chapter}', [ChapterController::class, 'show']);
});

Route::prefix('chapters/{chapter}/articles')->controller(ChapterArticleController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{article}', 'show');
});

Route::prefix('chapters/{chapter}/articles/{article}/products')->controller(ChapterArticleProductController::class)->group(function () {
    Route::get('/', 'index'); 
    Route::get('/{product}', 'show');
});

Route::post('/create-bc', [QuantitéCommandController::class, 'store']);