<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Inventaris</title>
</head>
<body>

    <!-- Header & Info User -->
    <table width="100%" border="0" style="margin-bottom: 10px;">
        <tr>
            <td>
                <h1>Dashboard Admin</h1>
                <p>Selamat datang kembali, <b>{{ Auth::user()->name }}</b> ({{ Auth::user()->email }})</p>
            </td>
            <td align="right">
                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin keluar?')">
                    @csrf
                    <button type="submit" style="background-color: #ff4d4d; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                        <b>Logout</b>
                    </button>
                </form>
            </td>
        </tr>
    </table>

    <hr>

    <!-- Notifikasi Pesan -->
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <!-- Menu Navigasi Utama -->
    <h3>Menu Navigasi</h3>
    <p>
        <a href="{{ route('dashboard') }}"><b>[ Dashboard ]</b></a> | 
        <a href="{{ route('barang.index') }}">Data Barang</a> | 
        <a href="{{ route('kategori.index') }}">Kategori Barang</a> | 
        <a href="{{ route('stok.index') }}">Stok Barang</a> | 
        <a href="{{ route('penyusutan.index') }}">Masa Ekonomis & Penyusutan</a> | 
        <a href="{{ route('kerusakan.index') }}">Laporan Kerusakan</a>
    </p>

    <hr>

    <!-- Ringkasan Statistik Kartu (Cards) -->
    <h3>Ringkasan Inventaris</h3>
    <table border="1" cellpadding="15" cellspacing="0" width="100%">
        <tr>
            <td width="25%" align="center" bgcolor="#f2f2f2">
                <h4>TOTAL BARANG</h4>
                <h2 style="color: blue;">{{ $totalBarang }}</h2>
                <small>Jenis Produk</small>
            </td>
            <td width="25%" align="center" bgcolor="#f2f2f2">
                <h4>TOTAL KATEGORI</h4>
                <h2 style="color: purple;">{{ $totalKategori }}</h2>
                <small>Kategori Aktif</small>
            </td>
            <td width="25%" align="center" bgcolor="#f2f2f2">
                <h4>TOTAL STOK BARANG</h4>
                <h2 style="color: green;">{{ $totalStok }}</h2>
                <small>Unit Tersedia</small>
            </td>
            <td width="25%" align="center" bgcolor="#f2f2f2">
                <h4>KERUSAKAN PENDING</h4>
                <h2 style="color: red;">{{ $laporanPending }}</h2>
                <small>Perlu Penanganan</small>
            </td>
        </tr>
    </table>

    <br>

    <!-- Ringkasan Aksi Cepat (Quick Actions) -->
    <h3>Aksi Cepat</h3>
    <p>
        <a href="{{ route('barang.create') }}">+ Tambah Barang Baru</a> | 
        <a href="{{ route('kategori.create') }}">+ Tambah Kategori</a> | 
        <a href="{{ route('stok.create') }}">+ Update/Tambah Stok</a> | 
        <a href="{{ route('kerusakan.create') }}">+ Laporkan Kerusakan</a>
    </p>

    <br>

    <!-- Tabel Laporan Kerusakan Terbaru -->
    <h3>Laporan Kerusakan Barang Terbaru</h3>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr bgcolor="#e6e6e6">
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah Rusak</th>
                <th>Tingkat Kerusakan</th>
                <th>Status</th>
                <th>Tanggal Lapor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kerusakanTerbaru as $item)
                <tr>
                    <td>#{{ $loop->iteration }}</td>
                    <td><b>{{ $item->barang->nama_barang ?? 'Barang Dihapus' }}</b></td>
                    <td>{{ $item->jumlah_rusak }} Unit</td>
                    <td>{{ $item->tingkat_kerusakan }}</td>
                    <td>
                        @if($item->status == 'Pending')
                            <span style="color: red;"><b>Pending</b></span>
                        @elseif($item->status == 'Diproses')
                            <span style="color: orange;"><b>Diproses</b></span>
                        @else
                            <span style="color: green;"><b>Selesai</b></span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" align="center">Belum ada laporan kerusakan terbaru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>