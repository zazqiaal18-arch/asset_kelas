<!DOCTYPE html>
<html>
<head>
    <title>Data Barang Kelas</title>
</head>
<body>

    <h1>Data Barang Kelas</h1>

    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <p>
        <a href="{{ route('barang.create') }}">+ Tambah Barang Baru</a>
    </p>

    <h3>Daftar Barang Kelas</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Beli</th>
                <th>Harga Beli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $item)
                <tr>
                    <!-- $loop->iteration otomatis generate nomor urut 1, 2, 3... -->
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tanggal_beli ?? '-' }}</td>
                    <td>{{ $item->harga_beli ? 'Rp ' . number_format($item->harga_beli, 0, ',', '.') : '-' }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $item->id_barang) }}">Edit</a> 
                        | 
                        <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin mau hapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>