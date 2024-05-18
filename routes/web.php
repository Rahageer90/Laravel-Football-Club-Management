<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;

// Route for registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Admin routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('announce-match', [AdminController::class, 'announceMatchForm'])->name('admin.announce_match.form');
    Route::post('announce-match', [AdminController::class, 'announceMatch'])->name('admin.announce_match');
    Route::delete('delete-match/{match_id}', [AdminController::class, 'deleteMatch'])->name('admin.delete_match');
    Route::get('update-match/{match_id}', [AdminController::class, 'updateMatchForm'])->name('admin.update_match.form');
    Route::post('update-match/{match_id}', [AdminController::class, 'updateMatch'])->name('admin.update_match');
});
