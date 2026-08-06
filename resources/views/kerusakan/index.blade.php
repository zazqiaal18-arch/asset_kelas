<!DOCTYPE html>
<html>
<head>
    <title>Data Kerusakan Barang</title>
</head>
<body>

    <h1>Laporan Kerusakan Barang</h1>

    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <p>
        <a href="{{ route('kerusakan.create') }}">+ Laporkan Kerusakan Baru</a>
    </p>

    <h3>Daftar Barang Rusak</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah Rusak</th>
                <th>Tingkat</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kerusakans as $item)
                <tr>
                    <td>#{{ $loop->iteration }}</td>
                    <td>{{ $item->barang->nama_barang ?? 'Barang Dihapus' }}</td>
                    <td>{{ $item->jumlah_rusak }}</td>
                    <td>{{ $item->tingkat_kerusakan }}</td>
                    <td>{{ $item->deskripsi_kerusakan }}</td>
                    <td><b>{{ $item->status }}</b></td>
                    <td>
                        <a href="{{ route('kerusakan.edit', $item->id_kerusakan) }}">Edit</a> 
                        | 
                        <form action="{{ route('kerusakan.destroy', $item->id_kerusakan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data kerusakan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada laporan kerusakan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>