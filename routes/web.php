<?php

use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\WalkthroughController as AdminWalkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WalkthroughController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
Route::get('/walkthroughs/{id}', [WalkthroughController::class, 'show'])->name('walkthroughs.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/games/{game_id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('games', AdminGameController::class);
    Route::resource('walkthroughs', AdminWalkController::class);
    Route::get('/walkthroughs/{walk_id}/chapters', [AdminChapterController::class, 'index'])->name('chapters.index');
    Route::post('/walkthroughs/{walk_id}/chapters', [AdminChapterController::class, 'store'])->name('chapters.store');
    Route::get('/chapters/{id}/edit', [AdminChapterController::class, 'edit'])->name('chapters.edit');
    Route::put('/chapters/{id}', [AdminChapterController::class, 'update'])->name('chapters.update');
    Route::delete('/chapters/{id}', [AdminChapterController::class, 'destroy'])->name('chapters.destroy');

});
