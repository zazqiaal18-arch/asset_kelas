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


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD USER
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'user') {

            // Hanya mengambil laporan milik user yang sedang login
            $kerusakansUser = Kerusakan::with('barang')
                ->where('user_id', $user->id)
                ->latest('id_kerusakan')
                ->get();


            return view('dashboard', [

                'isAdmin' => false,

                'kerusakansUser' => $kerusakansUser,

                'totalLaporanUser' => $kerusakansUser->count(),

                'totalMenungguUser' => $kerusakansUser
                    ->where('status_penanganan', 'Menunggu')
                    ->count(),

                'totalDikerjakanUser' => $kerusakansUser
                    ->where('status_penanganan', 'Dikerjakan')
                    ->count(),

                'totalSelesaiUser' => $kerusakansUser
                    ->where('status_penanganan', 'Selesai')
                    ->count(),

                'totalDitolakUser' => $kerusakansUser
                    ->where('status_penanganan', 'Ditolak')
                    ->count(),

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            $barangs = Barang::withSum(
                    'kerusakans',
                    'jumlah_rusak'
                )
                ->latest('id_barang')
                ->get();


            $totalBarang = $barangs->count();

            $totalKategori = Kategori::count();

            $totalUnitBarang = $barangs->sum('jumlah');

            $totalBarangRusak = Kerusakan::sum('jumlah_rusak');


            /*
            |--------------------------------------------------------------------------
            | DATA KERUSAKAN CHART
            |--------------------------------------------------------------------------
            */

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


            /*
            |--------------------------------------------------------------------------
            | PENYUSUTAN
            |--------------------------------------------------------------------------
            */

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


            /*
            |--------------------------------------------------------------------------
            | LAPORAN TERBARU
            |--------------------------------------------------------------------------
            */

            $recentKerusakan = Kerusakan::with([
                    'barang',
                    'user'
                ])
                ->latest('id_kerusakan')
                ->take(5)
                ->get();


            $barangsPreview = $barangs->take(5);


            return view('dashboard', [

                'isAdmin' => true,

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


        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK VALID
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'error',
                'Role akun tidak valid. Hubungi administrator.'
            );
    }
}