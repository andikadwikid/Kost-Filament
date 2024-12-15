<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/undian', fn() => view('pages.undian'));

Route::get('/', [HomeController::class, 'index'])->name('home');
