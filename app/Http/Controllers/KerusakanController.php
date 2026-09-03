<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Models\Barang;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    public function index()
    {
        $kerusakans = Kerusakan::with('barang')->latest('id_kerusakan')->get();
        return view('kerusakan.index', compact('kerusakans'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('kerusakan.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'           => 'required|exists:barangs,id_barang',
            'jumlah_rusak'        => 'required|integer|min:1',
            'tingkat_kerusakan'   => 'required|in:Ringan,Sedang,Berat',
            'deskripsi_kerusakan' => 'required|string',
        ]);

        Kerusakan::create($request->all());

        return redirect()->route('kerusakan.index')->with('success', 'Laporan kerusakan berhasil disimpan!');
    }

     public function show($id_kerusakan)
    {
        $kerusakan = Kerusakan::with('barang')->findOrFail($id_kerusakan);
        return view('kerusakan.show', compact('kerusakan'));
    }

    public function edit($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail($id_kerusakan);
        $barangs = Barang::all();
        return view('kerusakan.edit', compact('kerusakan', 'barangs'));
    }

    public function update(Request $request, $id_kerusakan)
    {
        $request->validate([
            'barang_id'           => 'required|exists:barangs,id_barang',
            'jumlah_rusak'        => 'required|integer|min:1',
            'tingkat_kerusakan'   => 'required|in:Ringan,Sedang,Berat',
            'deskripsi_kerusakan' => 'required|string',
        ]);

        $kerusakan = Kerusakan::findOrFail($id_kerusakan);
        $kerusakan->update($request->all());

        return redirect()->route('kerusakan.index')->with('success', 'Data kerusakan berhasil diperbarui!');
    }

    public function destroy($id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail($id_kerusakan);
        $kerusakan->delete();

        return redirect()->route('kerusakan.index')->with('success', 'Data kerusakan berhasil dihapus!');
    }
}
