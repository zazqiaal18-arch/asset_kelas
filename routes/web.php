<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenyusutanController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama aplikasi
Route::get('/', function () {
    return view('welcome');
});

// ROUTE AUTHENTICATION (Guest / Belum Login)
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    // Google OAuth
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
});

// LOGOUT (Bisa dipanggil kapan saja saat user login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']); // Jaga-jaga jika tombol logout di sidebar menggunakan tag <a> (GET)

// ROUTE DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ROUTE BARANG
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

// ROUTE STOK
Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
Route::get('/stok/create', [StokController::class, 'create'])->name('stok.create');
Route::post('/stok', [StokController::class, 'store'])->name('stok.store');
Route::get('/stok/{id_stok}/edit', [StokController::class, 'edit'])->name('stok.edit');
Route::put('/stok/{id_stok}', [StokController::class, 'update'])->name('stok.update');
Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])->name('stok.destroy');

// ROUTE KATEGORI
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id_kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id_kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id_kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// ROUTE PENYUSUTAN
Route::get('/penyusutan', [PenyusutanController::class, 'index'])->name('penyusutan.index');
Route::get('/penyusutan/create', [PenyusutanController::class, 'create'])->name('penyusutan.create');
Route::post('/penyusutan', [PenyusutanController::class, 'store'])->name('penyusutan.store');
Route::delete('/penyusutan/{id_penyusutan}', [PenyusutanController::class, 'destroy'])->name('penyusutan.destroy');

// ROUTE KERUSAKAN
Route::get('/kerusakan', [KerusakanController::class, 'index'])->name('kerusakan.index');
Route::get('/kerusakan/create', [KerusakanController::class, 'create'])->name('kerusakan.create');
Route::post('/kerusakan', [KerusakanController::class, 'store'])->name('kerusakan.store');
Route::delete('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'show'])->name('kerusakan.show');
Route::get('/kerusakan/{id_kerusakan}/edit', [KerusakanController::class, 'edit'])->name('kerusakan.edit');
Route::put('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'update'])->name('kerusakan.update');
Route::delete('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'destroy'])->name('kerusakan.destroy');

