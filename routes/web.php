<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenyusutanController;
use App\Http\Controllers\KerusakanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

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

// ROUTE KATEGORI BARANG
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id_kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id_kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id_kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// 4. ROUTE MASA EKONOMIS & PENYUSUTAN
Route::get('/penyusutan', [PenyusutanController::class, 'index'])->name('penyusutan.index');
Route::get('/penyusutan/create', [PenyusutanController::class, 'create'])->name('penyusutan.create');
Route::post('/penyusutan', [PenyusutanController::class, 'store'])->name('penyusutan.store');
Route::delete('/penyusutan/{id_penyusutan}', [PenyusutanController::class, 'destroy'])->name('penyusutan.destroy');

// 5. ROUTE KERUSAKAN BARANG
Route::get('/kerusakan', [KerusakanController::class, 'index'])->name('kerusakan.index');
Route::get('/kerusakan/create', [KerusakanController::class, 'create'])->name('kerusakan.create');
Route::post('/kerusakan', [KerusakanController::class, 'store'])->name('kerusakan.store');
Route::get('/kerusakan/{id_kerusakan}/edit', [KerusakanController::class, 'edit'])->name('kerusakan.edit');
Route::put('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'update'])->name('kerusakan.update');
Route::delete('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'destroy'])->name('kerusakan.destroy');