<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlaylistController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(ApiKeyMiddleware::class)->group(function () {
    Route::get('/playlists', [PlaylistController::class, 'index']);
});
