<?php

use App\Http\Controllers\MercadoLivreController;
use App\Http\Controllers\UserMLController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json('HOME');
});

Route::post('mercadolivre/callback', [MercadoLivreController::class, 'handleCallback']);

// Route::get('mercadolivre/novo', [MercadoLivreController::class, 'index']);

Route::get('refresh_token', [UserMLController::class, 'getLastTokenValid']);
