<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CollectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function (): void {
    Route::apiResource('boards', BoardController::class);
    Route::apiResource('collections', CollectionController::class);
});
