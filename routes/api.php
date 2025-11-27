<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas del Chatbot NINARI
Route::prefix('chatbot')->group(function () {
    Route::get('/welcome', [ChatbotController::class, 'welcome']);
    Route::post('/chat', [ChatbotController::class, 'chat']);
});
