<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\YouTubeController;
use App\Http\Controllers\SearchController;


Route::get('/', [ArticleController::class, 'index'])->name('home');

Route::get('/playlist/{playlistId}', [YouTubeController::class, 'showPlaylistVideos']);

Route::get('/wikipedia', [SearchController::class, 'wikipedia'])->name('wikipedia');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
