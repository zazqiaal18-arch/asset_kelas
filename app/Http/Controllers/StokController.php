<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $stoks = Stok::latest('id_stok')->get();
        return view('stok.index', compact('stoks'));
    }

    public function create()
    {
        return view('stok.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok_masuk'  => 'required|integer|min:0',
            'stok_keluar' => 'required|integer|min:0',
            'keterangan'  => 'nullable|string',
        ]);

        $total_stok = $request->stok_masuk - $request->stok_keluar;

        Stok::create([
            'nama_barang' => $request->nama_barang,
            'stok_masuk'  => $request->stok_masuk,
            'stok_keluar' => $request->stok_keluar,
            'total_stok'  => $total_stok,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect()->route('stok.index')->with('success', 'Data stok berhasil ditambahkan!');
    }

    public function edit($id_stok)
    {
        $stok = Stok::findOrFail($id_stok);
        return view('stok.edit', compact('stok'));
    }

    public function update(Request $request, $id_stok)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok_masuk'  => 'required|integer|min:0',
            'stok_keluar' => 'required|integer|min:0',
            'keterangan'  => 'nullable|string',
        ]);

        $stok = Stok::findOrFail($id_stok);
        $total_stok = $request->stok_masuk - $request->stok_keluar;

        $stok->update([
            'nama_barang' => $request->nama_barang,
            'stok_masuk'  => $request->stok_masuk,
            'stok_keluar' => $request->stok_keluar,
            'total_stok'  => $total_stok,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect()->route('stok.index')->with('success', 'Data stok berhasil diperbarui!');
    }

    public function destroy($id_stok)
    {
        $stok = Stok::findOrFail($id_stok);
        $stok->delete();

        return redirect()->route('stok.index')->with('success', 'Data stok berhasil dihapus!');
    }
}