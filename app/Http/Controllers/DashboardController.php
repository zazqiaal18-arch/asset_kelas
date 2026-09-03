<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Kerusakan;
use App\Models\Penyusutan;
use App\Models\Stok;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Ringkasan
        $totalBarang      = Barang::count();
        $totalKategori    = Kategori::count();
        $totalUnitBarang  = Barang::sum('jumlah');
        $totalBarangRusak = Kerusakan::sum('jumlah_rusak');

        // 2. Data Kerusakan untuk Chart
        $kerusakanRingan = Kerusakan::where('tingkat_kerusakan', 'Ringan')->sum('jumlah_rusak');
        $kerusakanSedang = Kerusakan::where('tingkat_kerusakan', 'Sedang')->sum('jumlah_rusak');
        $kerusakanBerat  = Kerusakan::where('tingkat_kerusakan', 'Berat')->sum('jumlah_rusak');

        // 3. Perhitungan Sisa Nilai Aset
        $penyusutans    = Penyusutan::with('barang')->get();
        $totalNilaiAset = 0;

        foreach ($penyusutans as $item) {
            $hargaBeli = $item->barang->harga_beli ?? 0;
            $tglBeli   = $item->barang->tanggal_beli ? Carbon::parse($item->barang->tanggal_beli) : null;

            if ($tglBeli) {
                $umurTahun = floor($tglBeli->diffInDays(now()) / 365);
                $totalPenyusutanBerjalan = $item->penyusutan_per_tahun * $umurTahun;
                $sisaNilai = max($item->nilai_residu, $hargaBeli - $totalPenyusutanBerjalan);
            } else {
                $sisaNilai = $hargaBeli;
            }
            $totalNilaiAset += $sisaNilai;
        }

        // 4. Data Preview
        $recentKerusakan = Kerusakan::with('barang')->latest()->take(5)->get();
        $barangs         = Barang::latest('id_barang')->take(5)->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalUnitBarang',
            'totalBarangRusak',
            'kerusakanRingan',
            'kerusakanSedang',
            'kerusakanBerat',
            'totalNilaiAset',
            'recentKerusakan',
            'barangs'
        ));
    }
}