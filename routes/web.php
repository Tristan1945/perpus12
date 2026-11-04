<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// Halaman publik (catalog)
Route::get('/', function () {
    return view('catalog');
});

// Dashboard
Route::get('/depan', function () {
    return view('dashboard.index');
})->name('dashboard');

// Data Siswa
Route::get('/data-siswa', [SiswaController::class, 'index'])->name('siswa');

// ============================================
// KATEGORI - CRUD LENGKAP (pake resource)
// ============================================
Route::resource('kategori', KategoriController::class)
    ->except(['create', 'show', 'edit']);