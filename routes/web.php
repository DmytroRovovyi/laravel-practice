<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WikiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\YouTubeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserNotificationController;


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

Route::get('upload-form', [WikiController::class, 'showForm'])->name('titles.upload.form');
Route::post('fetch-page', [WikiController::class, 'fetchPage'])->name('titles.fetch');

Route::get('/send-email/{userId}/{messageContent}', [UserNotificationController::class, 'sendEmail']);

require __DIR__.'/auth.php';
