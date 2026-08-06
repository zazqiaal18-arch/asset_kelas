<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Perhitungan Penyusutan</title>
</head>
<body>

    <p>
        <a href="{{ route('penyusutan.index') }}">← Kembali ke Daftar Penyusutan</a>
    </p>

    <h1>Edit Masa Ekonomis & Penyusutan</h1>

    <!-- Menampilkan pesan error validasi jika ada -->
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penyusutan.update', $penyusutan->id_penyusutan) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Pilih Barang Aset: </label><br>
            <select name="barang_id" required>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id_barang }}" {{ old('barang_id', $penyusutan->barang_id) == $barang->id_barang ? 'selected' : '' }}>
                        {{ $barang->nama_barang }} (Harga Beli: Rp {{ number_format($barang->harga_beli ?? 0, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Masa Ekonomis (Dalam Tahun): </label><br>
            <input type="number" name="masa_ekonomis" min="1" value="{{ old('masa_ekonomis', $penyusutan->masa_ekonomis) }}" required>
        </p>

        <p>
            <label>Nilai Residu / Nilai Sisa (Rp): </label><br>
            <input type="number" name="nilai_residu" min="0" value="{{ old('nilai_residu', $penyusutan->nilai_residu) }}">
        </p>

        <button type="submit">Update Perhitungan</button>
    </form>

</body>
</html>
