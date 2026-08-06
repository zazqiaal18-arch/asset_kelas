<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Perhitungan Penyusutan</title>
</head>
<body>

    <p>
        <a href="{{ route('penyusutan.index') }}">← Kembali ke Daftar Penyusutan</a>
    </p>

    <h1>Hitung Masa Ekonomis & Penyusutan Baru</h1>

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

    <form action="{{ route('penyusutan.store') }}" method="POST">
        @csrf

        <p>
            <label>Pilih Barang Aset: </label><br>
            <select name="barang_id" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id_barang }}" {{ old('barang_id') == $barang->id_barang ? 'selected' : '' }}>
                        {{ $barang->nama_barang }} (Harga Beli: Rp {{ number_format($barang->harga_beli ?? 0, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Masa Ekonomis (Dalam Tahun): </label><br>
            <input type="number" name="masa_ekonomis" min="1" value="{{ old('masa_ekonomis') }}" placeholder="Contoh: 5" required>
            <br><small style="color: gray;">Estimasi durasi pemakaian barang dalam hitungan tahun.</small>
        </p>

        <p>
            <label>Nilai Residu / Nilai Sisa (Rp): </label><br>
            <input type="number" name="nilai_residu" min="0" value="{{ old('nilai_residu', 0) }}" placeholder="Contoh: 100000">
            <br><small style="color: gray;">Perkiraan nilai jual/sisa aset setelah masa ekonomis habis (opsional, default: 0).</small>
        </p>

        <button type="submit">Hitung & Simpan Penyusutan</button>
    </form>

</body>
</html>
