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
        $barangs = Barang::withSum('kerusakans', 'jumlah_rusak')
            ->latest('id_barang')
            ->get();

        $totalBarang      = $barangs->count();
        $totalKategori    = Kategori::count();
        $totalUnitBarang  = $barangs->sum('jumlah');
        $totalBarangRusak = Kerusakan::sum('jumlah_rusak');

        // 2. Data Kerusakan untuk Chart
        $kerusakanRingan = Kerusakan::where('tingkat_kerusakan', 'Ringan')->sum('jumlah_rusak');
        $kerusakanSedang = Kerusakan::where('tingkat_kerusakan', 'Sedang')->sum('jumlah_rusak');
        $kerusakanBerat  = Kerusakan::where('tingkat_kerusakan', 'Berat')->sum('jumlah_rusak');

        $penyusutans = Penyusutan::get()->keyBy('barang_id');
        $totalNilaiAset = $barangs->sum(function ($barang) use ($penyusutans) {
            $hargaBeli = (float) ($barang->harga_beli ?? 0);
            $penyusutan = $penyusutans->get($barang->id_barang);

            if (!$penyusutan || !$barang->tanggal_beli) {
                return $hargaBeli;
            }

            $umurTahun = floor(Carbon::parse($barang->tanggal_beli)->diffInDays(now()) / 365);
            $nilaiBerjalan = $hargaBeli - ($penyusutan->penyusutan_per_tahun * $umurTahun);

            return max((float) $penyusutan->nilai_residu, $nilaiBerjalan);
        });

        $recentKerusakan = Kerusakan::with('barang')->latest()->take(5)->get();
        $barangsPreview  = $barangs->take(5);

        return view('dashboard', [
            'totalBarang' => $totalBarang,
            'totalKategori' => $totalKategori,
            'totalUnitBarang' => $totalUnitBarang,
            'totalBarangRusak' => $totalBarangRusak,
            'kerusakanRingan' => $kerusakanRingan,
            'kerusakanSedang' => $kerusakanSedang,
            'kerusakanBerat' => $kerusakanBerat,
            'totalNilaiAset' => $totalNilaiAset,
            'recentKerusakan' => $recentKerusakan,
            'barangs' => $barangsPreview,
        ]);
    }
}