<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Kategori</title>
</head>
<body>

    <a href="{{ route('kategori.index') }}">← Kembali ke Daftar Kategori</a>

    <h1>Edit Kategori: {{ $kategori->nama_kategori }}</h1>

    @if ($errors->any())
        <div style="color: red;">
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
            <label>Nama Kategori: </label><br>
            <input type="text"
                   name="nama_kategori"
                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                   required>
        </p>

        <button type="submit">Update Kategori</button>
    </form>

</body>
</html>
```
