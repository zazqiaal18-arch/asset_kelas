<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Stok;
use App\Models\Penyusutan;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Statistik Ringkasan
        $totalBarang     = Barang::count();
        $totalKategori   = Kategori::count();
        $totalStok       = Stok::sum('jumlah'); // Total seluruh unit barang
        $laporanPending  = Kerusakan::where('status', 'Pending')->count();
        $laporanDiproses = Kerusakan::where('status', 'Diproses')->count();
        $laporanSelesai  = Kerusakan::where('status', 'Selesai')->count();

        // 2. Kalkulasi Perkiraan Total Nilai Aset Saat Ini
        $totalNilaiAset = Barang::sum('harga_beli');

        // 3. Ambil 5 Laporan Kerusakan Terbaru
        $kerusakanTerbaru = Kerusakan::with('barang')
            ->latest('id_kerusakan')
            ->take(5)
            ->get();

        // 4. Ambil 5 Data Barang Terbaru
        $barangTerbaru = Barang::with('kategori')
            ->latest('id_barang')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalStok',
            'laporanPending',
            'laporanDiproses',
            'laporanSelesai',
            'totalNilaiAset',
            'kerusakanTerbaru',
            'barangTerbaru'
        ));
    }
}