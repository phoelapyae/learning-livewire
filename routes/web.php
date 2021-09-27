<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Http\Livewire\Dashboard::class);
    Route::get('/profile', \App\Http\Livewire\Profile::class);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', \App\Http\Livewire\Auth\Register::class)->name('auth.register');
    Route::get('/login', \App\Http\Livewire\Auth\Login::class)->name('auth.login');
});
