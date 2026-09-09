<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Models\Barang;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    /**
     * Menampilkan laporan kerusakan
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {

            // ADMIN melihat semua laporan
            $kerusakans = Kerusakan::with(['barang', 'user'])
                ->latest('id_kerusakan')
                ->get();

        } else {

            // USER hanya melihat laporan miliknya
            $kerusakans = Kerusakan::with('barang')
                ->where('user_id', auth()->id())
                ->latest('id_kerusakan')
                ->get();
        }

        return view(
            'kerusakan.index',
            compact('kerusakans')
        );
    }


    /**
     * Form laporan
     */
    public function create()
    {
        $barangs = Barang::all();

        return view(
            'kerusakan.create',
            compact('barangs')
        );
    }


    /**
     * Simpan laporan
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id_barang',

            'jumlah_rusak' => 'required|integer|min:1',

            'tingkat_kerusakan' =>
                'required|in:Ringan,Sedang,Berat',

            'deskripsi_kerusakan' =>
                'required|string',
        ]);


        Kerusakan::create([

            // User yang membuat laporan
            'user_id' => auth()->id(),

            // Data laporan
            'barang_id' => $request->barang_id,

            'jumlah_rusak' => $request->jumlah_rusak,

            'tingkat_kerusakan' =>
                $request->tingkat_kerusakan,

            'deskripsi_kerusakan' =>
                $request->deskripsi_kerusakan,

            // Status awal
            'status_penanganan' => 'Menunggu',

            // Tanggal laporan
            'tanggal_lapor' => now(),

        ]);


        return redirect()
            ->route('kerusakan.index')
            ->with(
                'success',
                'Laporan kerusakan berhasil dikirim dan menunggu persetujuan admin.'
            );
    }


    /**
     * Detail laporan
     */
    public function show($id_kerusakan)
    {
        $kerusakan = Kerusakan::with([
            'barang',
            'user'
        ])->findOrFail($id_kerusakan);


        // User tidak boleh melihat laporan orang lain
        if (
            auth()->user()->role !== 'admin' &&
            $kerusakan->user_id != auth()->id()
        ) {
            abort(403);
        }


        return view(
            'kerusakan.show',
            compact('kerusakan')
        );
    }


    /**
     * Edit laporan - ADMIN
     */
    public function edit($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail(
            $id_kerusakan
        );

        $barangs = Barang::all();


        return view(
            'kerusakan.edit',
            compact(
                'kerusakan',
                'barangs'
            )
        );
    }


    /**
     * Update laporan - ADMIN
     */
    public function update(
        Request $request,
        $id_kerusakan
    ) {

        $request->validate([
            'barang_id' =>
                'required|exists:barangs,id_barang',

            'jumlah_rusak' =>
                'required|integer|min:1',

            'tingkat_kerusakan' =>
                'required|in:Ringan,Sedang,Berat',

            'deskripsi_kerusakan' =>
                'required|string',
        ]);


        $kerusakan = Kerusakan::findOrFail(
            $id_kerusakan
        );


        $kerusakan->update([

            'barang_id' =>
                $request->barang_id,

            'jumlah_rusak' =>
                $request->jumlah_rusak,

            'tingkat_kerusakan' =>
                $request->tingkat_kerusakan,

            'deskripsi_kerusakan' =>
                $request->deskripsi_kerusakan,

        ]);


        return redirect()
            ->route('kerusakan.index')
            ->with(
                'success',
                'Data kerusakan berhasil diperbarui!'
            );
    }


    /**
     * Hapus laporan - ADMIN
     */
    public function destroy($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail(
            $id_kerusakan
        );

        $kerusakan->delete();


        return redirect()
            ->route('kerusakan.index')
            ->with(
                'success',
                'Laporan kerusakan berhasil dihapus!'
            );
    }


    // =========================================================
    // PROSES ADMIN
    // =========================================================


    /**
     * ADMIN menerima laporan
     */
    public function terima($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail(
            $id_kerusakan
        );


        $kerusakan->update([

            'status_penanganan' => 'Dikerjakan',

            'keterangan' =>
                'Laporan diterima dan sedang dikerjakan.',

        ]);


        return back()->with(
            'success',
            'Laporan diterima dan sekarang sedang dikerjakan.'
        );
    }


    /**
     * ADMIN menolak laporan
     */
    public function tolak(
        Request $request,
        $id_kerusakan
    ) {

        $request->validate([
            'keterangan' =>
                'nullable|string|max:1000',
        ]);


        $kerusakan = Kerusakan::findOrFail(
            $id_kerusakan
        );


        $kerusakan->update([

            'status_penanganan' => 'Ditolak',

            'keterangan' =>
                $request->keterangan
                ?: 'Laporan ditolak oleh admin.',

        ]);


        return back()->with(
            'success',
            'Laporan kerusakan telah ditolak.'
        );
    }


    /**
     * ADMIN menyelesaikan laporan
     */
    public function selesai($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail(
            $id_kerusakan
        );


        $kerusakan->update([

            'status_penanganan' => 'Selesai',

            'tanggal_selesai' => now(),

            'keterangan' =>
                'Kerusakan telah selesai ditangani.',

        ]);


        return back()->with(
            'success',
            'Laporan kerusakan berhasil diselesaikan.'
        );
    }
}