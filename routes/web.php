<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;

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