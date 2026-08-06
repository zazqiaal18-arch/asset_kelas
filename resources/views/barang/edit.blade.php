<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
</head>
<body>

    <a href="{{ route('barang.index') }}">← Kembali ke Daftar Barang</a>

    <h1>Edit Barang: {{ $barang->nama_barang }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Nama Barang: </label><br>
            <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </p>

        <p>
            <label>Jumlah / Stok: </label><br>
            <input type="number" name="jumlah" min="1" value="{{ old('jumlah', $barang->jumlah) }}" required>
        </p>

        <p>
            <label>Tanggal Beli:</label><br>
            <input type="date" name="tanggal_beli" value="{{ old('tanggal_beli', $barang->tanggal_beli) }}">
        </p>

        <p>
            <label>Harga Beli (Rp):</label><br>
            <input type="number" name="harga_beli" min="0" value="{{ old('harga_beli', $barang->harga_beli) }}">
        </p>

        <button type="submit">Update Barang</button>
    </form>

</body>
</html>