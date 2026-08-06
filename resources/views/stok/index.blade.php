<!DOCTYPE html>
<html>
<head>
    <title>Data Stok Barang</title>
</head>
<body>

    <h1>Data Stok Barang</h1>

    <p>
        <a href="{{ route('stok.create') }}">+ Tambah Data Stok</a>
    </p>

    <h3>Daftar Stok Barang</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Sisa Stok</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stoks as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->stok_masuk }}</td>
                    <td>{{ $item->stok_keluar }}</td>
                    <td><b>{{ $item->total_stok }}</b></td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td>
                        <a href="{{ route('stok.edit', $item->id_stok) }}">Edit</a> 
                        | 
                        <form action="{{ route('stok.destroy', $item->id_stok) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus stok ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data stok.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>