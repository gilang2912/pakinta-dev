<?php

use App\Http\Controllers\AuthtenticatedController;
use App\Http\Controllers\TestingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestingController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthtenticatedController::class, 'login'])->name('login');
