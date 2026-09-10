<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Kerusakan;
use App\Models\Penyusutan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ================================================================
        // DATA BARANG
        // ADMIN & USER SAMA-SAMA BOLEH MELIHAT
        // ================================================================

        $barangs = Barang::withSum(
                'kerusakans',
                'jumlah_rusak'
            )
            ->latest('id_barang')
            ->get();

        $totalBarang = $barangs->count();

        $totalKategori = Kategori::count();

        $totalUnitBarang = $barangs->sum('jumlah');


        // ================================================================
        // TOTAL BARANG RUSAK
        // ================================================================

        if ($user->role === 'admin') {

            // Admin melihat seluruh kerusakan
            $totalBarangRusak = Kerusakan::sum('jumlah_rusak');

        } else {

            // User hanya melihat jumlah kerusakan dari laporannya sendiri
            $totalBarangRusak = Kerusakan::where(
                'user_id',
                $user->id
            )->sum('jumlah_rusak');
        }


        // ================================================================
        // CHART KERUSAKAN
        // ================================================================

        if ($user->role === 'admin') {

            $kerusakanRingan = Kerusakan::where(
                'tingkat_kerusakan',
                'Ringan'
            )->sum('jumlah_rusak');

            $kerusakanSedang = Kerusakan::where(
                'tingkat_kerusakan',
                'Sedang'
            )->sum('jumlah_rusak');

            $kerusakanBerat = Kerusakan::where(
                'tingkat_kerusakan',
                'Berat'
            )->sum('jumlah_rusak');

        } else {

            $kerusakanRingan = Kerusakan::where(
                'user_id',
                $user->id
            )
            ->where('tingkat_kerusakan', 'Ringan')
            ->sum('jumlah_rusak');

            $kerusakanSedang = Kerusakan::where(
                'user_id',
                $user->id
            )
            ->where('tingkat_kerusakan', 'Sedang')
            ->sum('jumlah_rusak');

            $kerusakanBerat = Kerusakan::where(
                'user_id',
                $user->id
            )
            ->where('tingkat_kerusakan', 'Berat')
            ->sum('jumlah_rusak');
        }


        // ================================================================
        // PENYUSUTAN
        // ================================================================

        $penyusutans = Penyusutan::get()
            ->keyBy('barang_id');


        $totalNilaiAset = $barangs->sum(
            function ($barang) use ($penyusutans) {

                $hargaBeli = (float) (
                    $barang->harga_beli ?? 0
                );

                $penyusutan = $penyusutans->get(
                    $barang->id_barang
                );


                if (
                    !$penyusutan ||
                    !$barang->tanggal_beli
                ) {
                    return $hargaBeli;
                }


                $umurTahun = floor(
                    Carbon::parse(
                        $barang->tanggal_beli
                    )->diffInDays(now()) / 365
                );


                $nilaiBerjalan =
                    $hargaBeli -
                    (
                        $penyusutan->penyusutan_per_tahun
                        * $umurTahun
                    );


                return max(
                    (float) $penyusutan->nilai_residu,
                    $nilaiBerjalan
                );
            }
        );


        // ================================================================
        // LAPORAN KERUSAKAN TERBARU
        // ================================================================

        if ($user->role === 'admin') {

            // Admin melihat laporan semua user
            $recentKerusakan = Kerusakan::with([
                    'barang',
                    'user'
                ])
                ->latest('id_kerusakan')
                ->take(5)
                ->get();

        } else {

            // User hanya melihat laporan miliknya
            $recentKerusakan = Kerusakan::with('barang')
                ->where('user_id', $user->id)
                ->latest('id_kerusakan')
                ->take(5)
                ->get();
        }


        // ================================================================
        // PREVIEW BARANG
        // ================================================================

        $barangsPreview = $barangs->take(5);


        // ================================================================
        // KIRIM SEMUA DATA KE 1 DASHBOARD
        // ================================================================

        return view('dashboard', [

            'isAdmin' => $user->role === 'admin',
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