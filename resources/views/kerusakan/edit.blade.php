<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Kerusakan</title>
</head>
<body>

    <a href="{{ route('kerusakan.index') }}">← Kembali ke Data Kerusakan</a>

    <h1>Edit Laporan Kerusakan</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kerusakan.update', $kerusakan->id_kerusakan) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Pilih Barang: </label><br>
            <select name="barang_id" required>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id_barang }}" {{ $kerusakan->barang_id == $barang->id_barang ? 'selected' : '' }}>
                        {{ $barang->nama_barang }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Jumlah Rusak: </label><br>
            <input type="number" name="jumlah_rusak" min="1" value="{{ old('jumlah_rusak', $kerusakan->jumlah_rusak) }}" required>
        </p>

        <p>
            <label>Tingkat Kerusakan: </label><br>
            <select name="tingkat_kerusakan" required>
                <option value="Ringan" {{ $kerusakan->tingkat_kerusakan == 'Ringan' ? 'selected' : '' }}>Ringan</option>
                <option value="Sedang" {{ $kerusakan->tingkat_kerusakan == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="Berat" {{ $kerusakan->tingkat_kerusakan == 'Berat' ? 'selected' : '' }}>Berat</option>
            </select>
        </p>

        <p>
            <label>Deskripsi Kerusakan: </label><br>
            <textarea name="deskripsi_kerusakan" required>{{ old('deskripsi_kerusakan', $kerusakan->deskripsi_kerusakan) }}</textarea>
        </p>


        <button type="submit">Update Laporan</button>
    </form>

</body>
</html>