<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang Baru</title>
</head>
<body>
    <h1>Tambah Barang Baru</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        <p>
            <label>Nama Barang: </label><br>
            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required>
        </p>

        <p>
            <label>Jumlah / Stok: </label><br>
            <input type="number" name="jumlah" min="1" value="{{ old('jumlah') }}" required>
        </p>

        <p>
            <label>Tanggal Beli:</label><br>
            <input type="date" name="tanggal_beli" value="{{ old('tanggal_beli') }}">
        </p>

        <p>
            <label>Harga Beli (Rp):</label><br>
            <input type="number" name="harga_beli" min="0" placeholder="Contoh: 1500000" value="{{ old('harga_beli') }}">
        </p>

        <button type="submit">Simpan Barang</button>
    </form>

</body>
</html>