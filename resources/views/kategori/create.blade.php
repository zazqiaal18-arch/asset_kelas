<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori Baru</title>
</head>
<body>

    <h1>Tambah Kategori Baru</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <p>
            <label>Nama Kategori: </label><br>
            <input type="text"
                   name="nama_kategori"
                   value="{{ old('nama_kategori') }}"
                   required>
        </p>

        <button type="submit">Simpan Kategori</button>
    </form>

</body>
</html>
```
