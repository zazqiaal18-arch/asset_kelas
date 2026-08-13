<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Masa Penyusutan & Ekonomis Aset</title>
</head>
<body>

    <h1>Data Masa Ekonomis & Penyusutan Aset</h1>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <!-- Menu Navigasi Sederhana -->
    <p>
        <a href="{{ route('barang.index') }}">Data Barang</a> |
        <a href="{{ route('kategori.index') }}">Kategori</a> |
        <a href="{{ route('stok.index') }}">Stok</a> |
        <a href="{{ route('kerusakan.index') }}">Kerusakan</a>
    </p>

    <hr>

    <p>
        <a href="{{ route('penyusutan.create') }}">+ Hitung Masa Ekonomis Baru</a>
    </p>

    <h3>Daftar Perhitungan Penyusutan Aset</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tgl Beli</th>
                <th>Harga Beli</th>
                <th>Masa Ekonomis</th>
                <th>Nilai Residu</th>
                <th>Penyusutan / Tahun</th>
                <th>Sisa Nilai Saat Ini</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penyusutans as $item)
                @php
                    // Logika Perhitungan Sisa Nilai Saat Ini berdasarkan Umur Beli
                    $hargaBeli = $item->barang->harga_beli ?? 0;
                    $tglBeli = $item->barang->tanggal_beli ? \Carbon\Carbon::parse($item->barang->tanggal_beli) : null;

                    if ($tglBeli) {
                        $umurTahun = floor($tglBeli->diffInDays(now()) / 365);
                        // Hitung total penyusutan yang sudah berjalan
                        $totalPenyusutanBerjalan = $item->penyusutan_per_tahun * $umurTahun;
                        // Sisa Nilai = Harga Beli - Total Penyusutan (Tidak boleh lebih rendah dari nilai residu)
                        $sisaNilai = max($item->nilai_residu, $hargaBeli - $totalPenyusutanBerjalan);
                    } else {
                        $sisaNilai = $hargaBeli;
                    }
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><b>{{ $item->barang->nama_barang ?? 'Barang Dihapus' }}</b></td>
                    <td>{{ $item->barang->tanggal_beli ?? '-' }}</td>
                    <td>Rp {{ number_format($hargaBeli, 0, ',', '.') }}</td>
                    <td>{{ $item->masa_ekonomis }} Tahun</td>
                    <td>Rp {{ number_format($item->nilai_residu, 0, ',', '.') }}</td>
                    <td><span style="color: red;">- Rp {{ number_format($item->penyusutan_per_tahun, 0, ',', '.') }}</span> /thn</td>
                    <td><b style="color: green;">Rp {{ number_format($sisaNilai, 0, ',', '.') }}</b></td>
                    <td>
                        <form action="{{ route('penyusutan.destroy', $item->id_penyusutan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data perhitungan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Belum ada data perhitungan masa ekonomis & penyusutan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
