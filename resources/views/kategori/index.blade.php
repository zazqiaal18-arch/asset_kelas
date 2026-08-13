```blade
<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
</head>
<body>

    <h1>Data Kategori</h1>

    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <p>
        <a href="{{ route('kategori.create') }}">+ Tambah Kategori Baru</a>
    </p>

    <h3>Daftar Kategori</h3>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($kategori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nama_kategori }}</td>

                    <td>
                        <a href="{{ route('kategori.edit', $item->id_kategori) }}">
                            Edit
                        </a>

                        |

                        <form action="{{ route('kategori.destroy', $item->id_kategori) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Yakin mau hapus kategori ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="3">Belum ada data kategori.</td>
                </tr>

            @endforelse
        </tbody>
    </table>

</body>
</html>
```
