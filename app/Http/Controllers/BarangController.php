<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest('id_barang')->get();
        $totalBarang = Barang::count();
        return view('barang.index', compact('barangs','totalBarang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'jumlah'       => 'required|integer|min:1',
            'tanggal_beli' => 'nullable|date',
            'harga_beli'   => 'nullable|numeric|min:0',
        ]);

        $barang = Barang::create([
            'nama_barang'  => $request->nama_barang,
            'jumlah'       => $request->jumlah,
            'tanggal_beli' => $request->tanggal_beli,
            'harga_beli'   => $request->harga_beli,
        ]);

        $barang->update([
            'kode_barang' => 'BRG-' . str_pad($barang->id_barang, 4, '0', STR_PAD_LEFT),
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id_barang)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'jumlah'       => 'required|integer|min:1',
            'tanggal_beli' => 'nullable|date',
            'harga_beli'   => 'nullable|numeric|min:0',
        ]);

        $barang = Barang::findOrFail($id_barang);
        $barang->update([
            'nama_barang'  => $request->nama_barang,
            'jumlah'       => $request->jumlah,
            'tanggal_beli' => $request->tanggal_beli,
            'harga_beli'   => $request->harga_beli,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}