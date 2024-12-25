<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\AboutController;


Route::get('rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');
Route::post('/rekomendasi', [RekomendasiController::class, 'getRekomendasi'])->name('rekomendasi');
Route::get('/', [PlaceController::class, 'index']);
Route::get('about', [AboutController::class, 'index']);
Route::get('/places', [PlaceController::class, 'getPlaces'])->name('places.index');
