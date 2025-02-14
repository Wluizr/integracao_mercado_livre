<?php

use App\Http\Controllers\MercadoLivreController;
use App\Http\Controllers\UserMLController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('mercadolivre/callback', [MercadoLivreController::class, 'handleCallback']);
