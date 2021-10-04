<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Login;

Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class);
    Route::get('/profile', Profile::class);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('auth.register');
    Route::get('/login', Login::class)->name('auth.login');
});
