<?php

use App\Http\Controllers\pagesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [pagesController::class, 'base'])->name('base');


// Route Dashboard
Route::get('/', [pagesController::class, 'dashboard'])->name('dashboard');

// Route Pelanggan
Route::get('/pelanggan', [pagesController::class, 'pelangandash'])->name('pelanggan');
Route::get('/gruppelanggan', [pagesController::class, 'tambahgruppelanggan'])->name('tambahgruppelanggan');
Route::get('/petapelanggan', [pagesController::class, 'pemetaanpelanggan'])->name('pemetaanpelanggan');