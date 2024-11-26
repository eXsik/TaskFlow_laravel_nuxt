<?php

use App\Http\Controllers\BoardController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/boards', [BoardController::class, 'index']);
});


Route::get('/test-board2', function (Request $request) {
    return User::all();
});