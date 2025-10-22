<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserItemController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\SkinController;

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

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the API!']);
});


// auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('addCoin', [AuthController::class, 'addCoin']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
});

//score routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('scores', [ScoreController::class, 'store']); // submit new score
    Route::get('scores', [ScoreController::class, 'index']); // current user score history
    Route::get('leaderboard', [ScoreController::class, 'leaderboard']); // global top scores
});

// setting routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('settings', [UserSettingController::class, 'show']);
    Route::put('settings', [UserSettingController::class, 'update']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('items', [ItemController::class, 'index']);
    Route::get('items/{id}', [ItemController::class, 'show']);
});

// item routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('inventory', [UserItemController::class, 'index']);
    Route::post('inventory', [UserItemController::class, 'addItem']);
    Route::post('inventory/remove', [UserItemController::class, 'removeItem']);
});


/* Admin routes from here on */
Route::get('/players', [PlayerController::class, 'getAllPlayers']);
Route::post('/players/{player}/{action}', [PlayerController::class, 'toggleBanPlayer']);

Route::get('/skins', [SkinController::class, 'index']);
Route::post('/skins', [SkinController::class, 'store']);
Route::post('/skins/{skin}/{action}', [SkinController::class, 'toggleDelete']);

