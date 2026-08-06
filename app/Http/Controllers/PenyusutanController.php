<?php

namespace App\Http\Controllers;

use App\Models\Penyusutan;
use App\Models\Barang;
use Illuminate\Http\Request;

class PenyusutanController extends Controller
{
    public function index()
    {
        $penyusutans = Penyusutan::with('barang')->latest('id_penyusutan')->get();
        return view('penyusutan.index', compact('penyusutans'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('penyusutan.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'     => 'required|exists:barangs,id_barang',
            'masa_ekonomis' => 'required|integer|min:1',
            'nilai_residu'  => 'nullable|numeric|min:0',
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        $harga_beli = $barang->harga_beli ?? 0;
        $nilai_residu = $request->nilai_residu ?? 0;

        // Rumus Garis Lurus (Straight-Line Method)
        $penyusutan_per_tahun = ($harga_beli - $nilai_residu) / $request->masa_ekonomis;

        Penyusutan::create([
            'barang_id'            => $request->barang_id,
            'masa_ekonomis'        => $request->masa_ekonomis,
            'nilai_residu'         => $nilai_residu,
            'penyusutan_per_tahun' => max(0, $penyusutan_per_tahun),
        ]);

        return redirect()->route('penyusutan.index')->with('success', 'Perhitungan penyusutan berhasil disimpan!');
    }

    public function edit($id_penyusutan)
    {
        $penyusutan = Penyusutan::findOrFail($id_penyusutan);
        $barangs = Barang::all();
        return view('penyusutan.edit', compact('penyusutan', 'barangs'));
    }

    public function update(Request $request, $id_penyusutan)
    {
        $request->validate([
            'barang_id'     => 'required|exists:barangs,id_barang',
            'masa_ekonomis' => 'required|integer|min:1',
            'nilai_residu'  => 'nullable|numeric|min:0',
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        $harga_beli = $barang->harga_beli ?? 0;
        $nilai_residu = $request->nilai_residu ?? 0;

        // Hitung Ulang Rumus
        $penyusutan_per_tahun = ($harga_beli - $nilai_residu) / $request->masa_ekonomis;

        $penyusutan = Penyusutan::findOrFail($id_penyusutan);
        $penyusutan->update([
            'barang_id'            => $request->barang_id,
            'masa_ekonomis'        => $request->masa_ekonomis,
            'nilai_residu'         => $nilai_residu,
            'penyusutan_per_tahun' => max(0, $penyusutan_per_tahun),
        ]);

        return redirect()->route('penyusutan.index')->with('success', 'Data penyusutan berhasil diperbarui!');
    }

    public function destroy($id_penyusutan)
    {
        $penyusutan = Penyusutan::findOrFail($id_penyusutan);
        $penyusutan->delete();

        return redirect()->route('penyusutan.index')->with('success', 'Data penyusutan berhasil dihapus!');
    }
}