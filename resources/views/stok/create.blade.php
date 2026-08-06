<!DOCTYPE html>
<html>
<head>
    <title>Tambah Stok Barang</title>
</head>
<body>

    <a href="{{ route('stok.index') }}">← Kembali ke Data Stok</a>

    <h1>Tambah Stok Barang</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stok.store') }}" method="POST">
        @csrf

        <p>
            <label>Nama Barang: </label><br>
            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required>
        </p>

        <p>
            <label>Stok Masuk: </label><br>
            <input type="number" name="stok_masuk" min="0" value="{{ old('stok_masuk', 0) }}" required>
        </p>

        <p>
            <label>Stok Keluar: </label><br>
            <input type="number" name="stok_keluar" min="0" value="{{ old('stok_keluar', 0) }}" required>
        </p>

        <p>
            <label>Keterangan: </label><br>
            <textarea name="keterangan">{{ old('keterangan') }}</textarea>
        </p>

        <button type="submit">Simpan Stok</button>
    </form>

</body>
</html>