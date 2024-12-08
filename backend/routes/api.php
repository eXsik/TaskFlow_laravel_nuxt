<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function (): void {
    Route::apiResource('boards', BoardController::class);
    Route::apiResource('cards', CardController::class);
    Route::get('cards/{card}/tickets', [TicketController::class, 'getTicketsByCard']);
    Route::post('cards/{card}/tickets', [TicketController::class, 'store']);
});
