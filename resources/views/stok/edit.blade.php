<!DOCTYPE html>
<html>
<head>
    <title>Edit Stok Barang</title>
</head>
<body>

    <a href="{{ route('stok.index') }}">← Kembali ke Data Stok</a>

    <h1>Edit Stok: {{ $stok->nama_barang }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stok.update', $stok->id_stok) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Nama Barang: </label><br>
            <input type="text" name="nama_barang" value="{{ old('nama_barang', $stok->nama_barang) }}" required>
        </p>

        <p>
            <label>Stok Masuk: </label><br>
            <input type="number" name="stok_masuk" min="0" value="{{ old('stok_masuk', $stok->stok_masuk) }}" required>
        </p>

        <p>
            <label>Stok Keluar: </label><br>
            <input type="number" name="stok_keluar" min="0" value="{{ old('stok_keluar', $stok->stok_keluar) }}" required>
        </p>

        <p>
            <label>Keterangan: </label><br>
            <textarea name="keterangan">{{ old('keterangan', $stok->keterangan) }}</textarea>
        </p>

        <button type="submit">Update Stok</button>
    </form>

</body>
</html>