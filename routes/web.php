<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenyusutanController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use App\Http\Middleware\AdminMiddleware;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// ========================================================================
// HALAMAN UTAMA
// ========================================================================

Route::get('/', function () {
    return view('welcome');
});


// ========================================================================
// AUTHENTICATION - GUEST
// ========================================================================

Route::middleware('guest')->group(function () {

    // --------------------------------------------------------------------
    // REGISTER
    // --------------------------------------------------------------------

    Route::get('/register', [AuthController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');


    // --------------------------------------------------------------------
    // LOGIN
    // --------------------------------------------------------------------

    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');


    // --------------------------------------------------------------------
    // GOOGLE LOGIN
    // --------------------------------------------------------------------

    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])
        ->name('auth.google');

    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])
        ->name('auth.google.callback');

});


// ========================================================================
// LOGOUT
// ========================================================================

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ========================================================================
// ROUTE BERSAMA - ADMIN & USER
// ========================================================================

Route::middleware(['auth'])->group(function () {

    // --------------------------------------------------------------------
    // DASHBOARD
    // --------------------------------------------------------------------

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // --------------------------------------------------------------------
    // LIHAT DATA
    // --------------------------------------------------------------------

    Route::get('/barang', [BarangController::class, 'index'])
        ->name('barang.index');

    Route::get('/stok', [StokController::class, 'index'])
        ->name('stok.index');

    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('kategori.index');

    Route::get('/penyusutan', [PenyusutanController::class, 'index'])
        ->name('penyusutan.index');


    // ====================================================================
    // KERUSAKAN - USER & ADMIN
    // ====================================================================

    // Melihat laporan kerusakan
    Route::get('/kerusakan', [KerusakanController::class, 'index'])
        ->name('kerusakan.index');


    // Form laporan kerusakan
    Route::get('/kerusakan/create', [KerusakanController::class, 'create'])
        ->name('kerusakan.create');


    // Menyimpan laporan kerusakan
    Route::post('/kerusakan', [KerusakanController::class, 'store'])
        ->name('kerusakan.store');

});


// ========================================================================
// ROUTE KHUSUS ADMIN
// ========================================================================

Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    // ====================================================================
    // BARANG
    // ====================================================================

    Route::get('/barang/create', [BarangController::class, 'create'])
        ->name('barang.create');

    Route::post('/barang', [BarangController::class, 'store'])
        ->name('barang.store');

    Route::get('/barang/{id_barang}/edit', [BarangController::class, 'edit'])
        ->name('barang.edit');

    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])
        ->name('barang.update');

    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])
        ->name('barang.destroy');


    // ====================================================================
    // STOK
    // ====================================================================

    Route::get('/stok/create', [StokController::class, 'create'])
        ->name('stok.create');

    Route::post('/stok', [StokController::class, 'store'])
        ->name('stok.store');

    Route::get('/stok/{id_stok}/edit', [StokController::class, 'edit'])
        ->name('stok.edit');

    Route::put('/stok/{id_stok}', [StokController::class, 'update'])
        ->name('stok.update');

    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])
        ->name('stok.destroy');


    // ====================================================================
    // KATEGORI
    // ====================================================================

    Route::get('/kategori/create', [KategoriController::class, 'create'])
        ->name('kategori.create');

    Route::post('/kategori', [KategoriController::class, 'store'])
        ->name('kategori.store');

    Route::get('/kategori/{id_kategori}/edit', [KategoriController::class, 'edit'])
        ->name('kategori.edit');

    Route::put('/kategori/{id_kategori}', [KategoriController::class, 'update'])
        ->name('kategori.update');

    Route::delete('/kategori/{id_kategori}', [KategoriController::class, 'destroy'])
        ->name('kategori.destroy');


    // ====================================================================
    // PENYUSUTAN
    // ====================================================================

    Route::get('/penyusutan/create', [PenyusutanController::class, 'create'])
        ->name('penyusutan.create');

    Route::post('/penyusutan', [PenyusutanController::class, 'store'])
        ->name('penyusutan.store');

    Route::get('/penyusutan/{id_penyusutan}/edit', [PenyusutanController::class, 'edit'])
        ->name('penyusutan.edit');

    Route::put('/penyusutan/{id_penyusutan}', [PenyusutanController::class, 'update'])
        ->name('penyusutan.update');

    Route::delete('/penyusutan/{id_penyusutan}', [PenyusutanController::class, 'destroy'])
        ->name('penyusutan.destroy');


    // ====================================================================
    // KERUSAKAN - ADMIN
    // ====================================================================

    // --------------------------------------------------------------------
    // Detail laporan
    // --------------------------------------------------------------------

    Route::get('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'show'])
        ->name('kerusakan.show');


    // --------------------------------------------------------------------
    // Edit laporan
    // --------------------------------------------------------------------

    Route::get('/kerusakan/{id_kerusakan}/edit', [KerusakanController::class, 'edit'])
        ->name('kerusakan.edit');


    // --------------------------------------------------------------------
    // Update laporan
    // --------------------------------------------------------------------

    Route::put('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'update'])
        ->name('kerusakan.update');


    // --------------------------------------------------------------------
    // Hapus laporan
    // --------------------------------------------------------------------

    Route::delete('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'destroy'])
        ->name('kerusakan.destroy');


    // ====================================================================
    // PROSES LAPORAN KERUSAKAN
    // ====================================================================

    // --------------------------------------------------------------------
    // TERIMA LAPORAN
    // Menunggu -> Dikerjakan
    // --------------------------------------------------------------------

    Route::put(
        '/kerusakan/{id_kerusakan}/terima',
        [KerusakanController::class, 'terima']
    )->name('kerusakan.terima');


    // --------------------------------------------------------------------
    // TOLAK LAPORAN
    // Menunggu -> Ditolak
    // --------------------------------------------------------------------

    Route::put(
        '/kerusakan/{id_kerusakan}/tolak',
        [KerusakanController::class, 'tolak']
    )->name('kerusakan.tolak');


    // --------------------------------------------------------------------
    // SELESAIKAN LAPORAN
    // Dikerjakan -> Selesai
    // --------------------------------------------------------------------

    Route::put(
        '/kerusakan/{id_kerusakan}/selesai',
        [KerusakanController::class, 'selesai']
    )->name('kerusakan.selesai');

});