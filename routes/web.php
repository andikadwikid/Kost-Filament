<?php

use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/undian', fn() => view('pages.undian'));

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/booking', [BookingController::class, 'check'])->name('check-booking');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/city/{slug}', [CityController::class, 'show'])->name('city.show');

Route::get('/kost/{slug}', [BoardingHouseController::class, 'show'])->name('boarding-house.show');

Route::get('/find-kost', [BoardingHouseController::class, 'find'])->name('find-kost');
Route::get('/find-results', [BoardingHouseController::class, 'findResults'])->name('find-kost.results');
