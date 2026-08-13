<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori Barang</title>
</head>
<body>

    <p>
        <a href="{{ route('kategori.index') }}">← Kembali ke Daftar Kategori</a>
    </p>

    <h1>Edit Kategori Barang</h1>

    <!-- Menampilkan Error Validasi jika Inputan Salah -->
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="nama_kategori">Nama Kategori:</label><br>
            <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Contoh: Elektronik, Mebel, dll." required>
        </p>

        <p>
            <label for="deskripsi">Deskripsi Kategori:</label><br>
            <textarea id="deskripsi" name="deskripsi" rows="4" cols="40" placeholder="Keterangan singkat kategori (opsional)">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </p>

        <button type="submit">Update Kategori</button>
    </form>

</body>
</html>