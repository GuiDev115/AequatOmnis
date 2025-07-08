<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth routes (public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

// Jogos routes
Route::apiResource('jogos', JogoController::class);
Route::post('jogos/{id}/featured-image', [JogoController::class, 'uploadFeaturedImage']);

// Vendas routes
Route::apiResource('vendas', VendaController::class);

// Admin routes (for compatibility)
Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/', [JogoController::class, 'index']);
    Route::put('/{id}', [JogoController::class, 'update']);
});

// Client routes (for compatibility)
Route::prefix('client')->group(function () {
    Route::post('/', [AuthController::class, 'register']);
});

// Uploads routes (for compatibility with frontend)
Route::prefix('uploads')->group(function () {
    Route::post('/', function() {
        return response()->json(['message' => 'Upload functionality moved to specific endpoints']);
    });
});

// Venda routes (for compatibility)
Route::prefix('venda')->group(function () {
    Route::get('/', [VendaController::class, 'index']);
    Route::post('/', [VendaController::class, 'store']);
    Route::get('/{id}', [VendaController::class, 'show']);
    Route::put('/{id}', [VendaController::class, 'update']);
    Route::delete('/{id}', [VendaController::class, 'destroy']);
});
