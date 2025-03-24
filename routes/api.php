<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\AuthApiController;

// Create api users.
Route::post('/users', [UserApiController::class, 'store']);
Route::middleware('auth:sanctum')->get('/users/{id}', [UserApiController::class, 'show']);
Route::put('/users/{id}', [UserApiController::class, 'update']);
Route::delete('/users/{id}', [UserApiController::class, 'destroy']);

// Login api users.
Route::post('/login', [AuthApiController::class, 'login']);
