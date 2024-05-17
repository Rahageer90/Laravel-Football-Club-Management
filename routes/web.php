<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

// Route to display the registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');

// Route to handle registration form submission
Route::post('/register', [RegisterController::class, 'register'])->name('register');
