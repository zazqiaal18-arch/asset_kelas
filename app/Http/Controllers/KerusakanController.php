<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KerusakanController extends Controller
{
    /**
     * Menampilkan laporan kerusakan
     *
     * ADMIN:
     * - Melihat semua laporan
     *
     * USER:
     * - Hanya melihat laporan miliknya sendiri
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {

            // Admin melihat semua laporan
            $kerusakans = Kerusakan::with(['barang', 'user'])
                ->latest('id_kerusakan')
                ->get();

        } else {

            // User hanya melihat laporan yang dibuat oleh dirinya
            $kerusakans = Kerusakan::with('barang')
                ->where('user_id', $user->id)
                ->latest('id_kerusakan')
                ->get();
        }

        return view('kerusakan.index', compact('kerusakans'));
    }


    /**
     * Form laporan kerusakan
     */
    public function create()
    {
        $barangs = Barang::all();

        return view('kerusakan.create', compact('barangs'));
    }


    /**
     * Menyimpan laporan kerusakan
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id_barang',

            'jumlah_rusak' => 'required|integer|min:1',

            'tingkat_kerusakan' => 'required|in:Ringan,Sedang,Berat',

            'deskripsi_kerusakan' => 'required|string',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan ada user yang sedang login
        |--------------------------------------------------------------------------
        */

        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }


        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Simpan laporan
        |--------------------------------------------------------------------------
        |
        | user_id diambil langsung dari akun yang sedang login.
        | Jadi user tidak bisa menentukan user_id sendiri dari form.
        |
        */

        Kerusakan::create([
            'user_id' => $user->id,

            'barang_id' => $request->barang_id,

            'jumlah_rusak' => $request->jumlah_rusak,

            'tingkat_kerusakan' => $request->tingkat_kerusakan,

            'deskripsi_kerusakan' => $request->deskripsi_kerusakan,

            // Status awal laporan
            'status_penanganan' => 'Menunggu',

            // Waktu laporan dibuat
            'tanggal_lapor' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect kembali ke halaman kerusakan
        |--------------------------------------------------------------------------
        |
        | Karena index() sudah membedakan Admin dan User berdasarkan role,
        | User akan melihat laporan miliknya sendiri.
        |
        */

        return redirect()
            ->route('kerusakan.index')
            ->with(
                'success',
                'Laporan kerusakan berhasil dikirim dan menunggu persetujuan admin.'
            );
    }


    /**
     * Detail laporan kerusakan
     */
    public function show($id_kerusakan)
    {
        $kerusakan = Kerusakan::with([
            'barang',
            'user'
        ])->findOrFail($id_kerusakan);


        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | User hanya boleh melihat laporan miliknya
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'admin' &&
            (int) $kerusakan->user_id !== (int) $user->id
        ) {
            abort(403);
        }


        return view(
            'kerusakan.show',
            compact('kerusakan')
        );
    }


    /**
     * Edit laporan kerusakan
     * Hanya ADMIN
     */
    public function edit($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail($id_kerusakan);

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
     * Update laporan kerusakan
     * Hanya ADMIN
     */
    public function update(
        Request $request,
        $id_kerusakan
    ) {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id_barang',

            'jumlah_rusak' => 'required|integer|min:1',

            'tingkat_kerusakan' => 'required|in:Ringan,Sedang,Berat',

            'deskripsi_kerusakan' => 'required|string',
        ]);


        $kerusakan = Kerusakan::findOrFail($id_kerusakan);


        $kerusakan->update([
            'barang_id' => $request->barang_id,

            'jumlah_rusak' => $request->jumlah_rusak,

            'tingkat_kerusakan' => $request->tingkat_kerusakan,

            'deskripsi_kerusakan' => $request->deskripsi_kerusakan,
        ]);


        return redirect()
            ->route('kerusakan.index')
            ->with(
                'success',
                'Data kerusakan berhasil diperbarui!'
            );
    }


    /**
     * Hapus laporan kerusakan
     * Hanya ADMIN
     */
    public function destroy($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail($id_kerusakan);

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
     *
     * Menunggu -> Dikerjakan
     */
    public function terima($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail($id_kerusakan);


        // Hanya laporan Menunggu yang bisa diterima
        if ($kerusakan->status_penanganan !== 'Menunggu') {
            return back()->with(
                'error',
                'Laporan ini tidak dapat diterima karena statusnya sudah berubah.'
            );
        }


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
     *
     * Menunggu -> Ditolak
     */
    public function tolak(
        Request $request,
        $id_kerusakan
    ) {
        $request->validate([
            'keterangan' => 'nullable|string|max:1000',
        ]);


        $kerusakan = Kerusakan::findOrFail($id_kerusakan);


        // Hanya laporan Menunggu yang bisa ditolak
        if ($kerusakan->status_penanganan !== 'Menunggu') {
            return back()->with(
                'error',
                'Laporan ini tidak dapat ditolak karena statusnya sudah berubah.'
            );
        }


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
     *
     * Dikerjakan -> Selesai
     */
    public function selesai($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail($id_kerusakan);


        // Hanya laporan Dikerjakan yang bisa diselesaikan
        if ($kerusakan->status_penanganan !== 'Dikerjakan') {
            return back()->with(
                'error',
                'Laporan ini belum berstatus Dikerjakan.'
            );
        }


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