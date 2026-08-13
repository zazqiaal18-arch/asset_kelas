<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori Barang</title>
</head>
<body>

    <h2>Daftar Kategori Barang</h2>

    <!-- Alert Notifikasi Sukses -->
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <!-- Alert Notifikasi Error -->
    @if(session('error'))
        <p style="color: red;"><b>{{ session('error') }}</b></p>
    @endif

    <!-- Tombol Tambah Kategori -->
    <a href="{{ route('kategori.create') }}">
        <button style="padding: 8px 12px; margin-bottom: 15px; cursor: pointer;">
            + Tambah Kategori Baru
        </button>
    </a>

    <!-- Tabel Data Kategori -->
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="width: 50px;">No</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th style="width: 180px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori as $index => $item)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td><b>{{ $item->nama_kategori }}</b></td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td align="center">
                        <!-- Tombol Edit -->
                        <a href="{{ route('kategori.edit', $item->id_kategori) }}">
                            <button style="background-color: #ffc107; border: none; padding: 5px 10px; cursor: pointer;">
                                Edit
                            </button>
                        </a>

                        <!-- Form Hapus -->
                        <form action="{{ route('kategori.destroy', $item->id_kategori) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" align="center">Belum ada data kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    <!-- Tombol Kembali ke Dashboard/Barang -->
    <a href="{{ route('barang.index') }}">← Kembali ke Data Barang</a>

</body>
</html>