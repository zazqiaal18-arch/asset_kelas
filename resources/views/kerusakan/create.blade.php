<!DOCTYPE html>
<html>
<head>
    <title>Laporkan Kerusakan</title>
</head>
<body>

    <a href="{{ route('kerusakan.index') }}">← Kembali ke Data Kerusakan</a>

    <h1>Laporkan Kerusakan Barang</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kerusakan.store') }}" method="POST">
        @csrf

        <p>
            <label>Pilih Barang: </label><br>
            <select name="barang_id" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Jumlah Rusak: </label><br>
            <input type="number" name="jumlah_rusak" min="1" value="{{ old('jumlah_rusak', 1) }}" required>
        </p>

        <p>
            <label>Tingkat Kerusakan: </label><br>
            <select name="tingkat_kerusakan" required>
                <option value="Ringan">Ringan</option>
                <option value="Sedang">Sedang</option>
                <option value="Berat">Berat</option>
            </select>
        </p>

        <p>
            <label>Deskripsi Kerusakan: </label><br>
            <textarea name="deskripsi_kerusakan" required>{{ old('deskripsi_kerusakan') }}</textarea>
        </p>

        <p>
            <label>Status Perbaikan: </label><br>
            <select name="status" required>
                <option value="Dilaporkan">Dilaporkan</option>
                <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                <option value="Selesai">Selesai</option>
                <option value="Afkir/Dibuang">Afkir/Dibuang</option>
            </select>
        </p>

        <button type="submit">Simpan Laporan</button>
    </form>

</body>
</html>