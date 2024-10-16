<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/profiles/main', [ProfileController::class, 'main'])->name('dashboard');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
