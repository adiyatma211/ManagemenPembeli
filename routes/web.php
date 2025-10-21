<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\PelangganController;

// Route::get('/', [pagesController::class, 'base'])->name('base');


// Default route redirects to Pelanggan (list)
Route::get('/', function () {
    return redirect('/pelanggan');
});

// Route Pelanggan
Route::get('/pelanggan', [pagesController::class, 'pelangandash'])->name('pelanggan');
Route::get('/searcPelanggan', [pagesController::class, 'searcPelanggan'])->name('searcPelanggan');
Route::get('/getPelanggan', [pagesController::class, 'getPelanggan'])->name('getPelanggan');
Route::get('/getAllPelanggan', [pagesController::class, 'getAllPelanggan'])->name('getAllPelanggan');
Route::get('/getAllPelangganPemetaan', [pagesController::class, 'search'])->name('getAllPelangganPemetaan');
Route::get('/tambahpelanggan', [pagesController::class, 'tambahpelanggan'])->name('pemetaanpelanggan');
Route::get('/gruppelanggan', [pagesController::class, 'tambahgruppelanggan'])->name('tambahgruppelanggan');
Route::get('/petapelanggan', [pagesController::class, 'pemetaanpelanggan'])->name('pemetaanpelanggan');
Route::post('/simpanpelanggan', [PelangganController::class, 'store'])->name('tambahpelanggan');
Route::post('/simpankepalagrup', [PelangganController::class, 'storeKepalaGrup'])->name('simpankepalagrup');
Route::post('/importexcel', [PelangganController::class, 'import'])->name('import');
Route::post('/update-hari/{hari}', [PelangganController::class, 'updateHari'])->name('updateHari');
Route::post('/reset-hari', [PelangganController::class, 'resethari'])->name('resethari');
Route::post('/nik-copied', [PelangganController::class, 'nikCopied'])->name('nik.copied');


