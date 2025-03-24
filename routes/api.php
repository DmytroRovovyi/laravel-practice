<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ArticleApiController;

// Users api.
Route::post('/users', [UserApiController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/{id}', [UserApiController::class, 'show']);
    Route::put('/users/{id}', [UserApiController::class, 'update']);
    Route::delete('/users/{id}', [UserApiController::class, 'destroy']);
});

// Login api users.
Route::post('/login', [AuthApiController::class, 'login']);

// Article api.
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/articles', [ArticleApiController::class, 'store']);
    Route::get('/articles/{id}', [ArticleApiController::class, 'show']);
    Route::put('/articles/{id}', [ArticleApiController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleApiController::class, 'destroy']);
});
