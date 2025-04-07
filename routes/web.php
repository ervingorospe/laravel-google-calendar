<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', [GoogleController::class, 'index'])->name('login');

Route::get('/login/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [GoogleController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [GoogleController::class, 'logout'])->name('logout');
    Route::get('/event/{id}', [GoogleController::class, 'show'])->name('event.show');
    Route::delete('/delete/{id}', [GoogleController::class, 'destroy'])->name('event.delete');
    Route::post('/store', [GoogleController::class, 'store'])->name('event.store');
    Route::get('/create', [GoogleController::class, 'create'])->name('event.create');
    Route::put('/update/{id}', [GoogleController::class, 'update'])->name('event.update');
});