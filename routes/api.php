<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\LancamentoController;
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

Route::group([
    //'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    //Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::put('/user-profile/edit/{user}', [AuthController::class, 'update']);
    Route::put('/user-profile/edit-password/{user}', [AuthController::class, 'updatePassword']);

    Route::get('/contas', [ContaController::class, 'index']);
    Route::post('/contas', [ContaController::class, 'store']);
    Route::get('/contas/{conta}', [ContaController::class, 'show']);
    Route::post('/contas/buscar', [ContaController::class, 'buscar']);
    Route::put('/contas/{conta}', [ContaController::class, 'update']);
    Route::get('/contas/pagar/{conta}', [ContaController::class, 'pagar']);
    Route::delete('/contas/{conta}', [ContaController::class, 'destroy']);

    Route::get('/lancamentos', [LancamentoController::class, 'index']);
    Route::get('/lancamentos/diarios', [LancamentoController::class, 'diarios']);
    Route::post('/lancamentos', [LancamentoController::class, 'store']);
});
