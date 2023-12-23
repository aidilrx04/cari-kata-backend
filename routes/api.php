<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\GameOwner;
use App\Http\Middleware\IsUserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('api')->prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class)->only(['index']);
    Route::apiResource('users', UserController::class)->except(['index', 'store'])->middleware(['auth:sanctum', IsUserData::class]);

    Route::apiResource('games', GameController::class)->middleware(['auth:sanctum', GameOwner::class]);


    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });
});
