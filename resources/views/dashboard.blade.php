<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Inventaris Aset</title>
</head>
<body>

    <!-- Header Navigasi & Profil -->
    <header>
        <h2>Dashboard Admin Inventaris</h2>
        <p>Selamat datang kembali, <b>{{ Auth::user()->name ?? 'Admin' }}</b> ({{ Auth::user()->email ?? '-' }})</p>
        
        <!-- Menu Navigasi Modul -->
        <nav>
            <a href="{{ route('dashboard') }}"><b>[ Dashboard ]</b></a> | 
            <a href="{{ route('barang.index') }}">Data Barang</a> | 
            <a href="{{ route('kategori.index') }}">Kategori</a> | 
            <a href="{{ route('stok.index') }}">Stok Barang</a> | 
            <a href="{{ route('penyusutan.index') }}">Penyusutan Aset</a> | 
            <a href="{{ route('kerusakan.index') }}">Laporan Kerusakan</a> | 
            
            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin keluar?')">
                @csrf
                <button type="submit" style="color: red; cursor: pointer;">Logout</button>
            </form>
        </nav>
    </header>

    <hr>

    <!-- Notifikasi Pesan Sukses/Error -->
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <!-- Section 1: Kartu Ringkasan Statistik -->
    <h3>Ringkasan Inventaris</h3>
    <table border="1" cellpadding="15" cellspacing="0" style="width: 100%; text-align: center;">
        <tr>
            <td style="background-color: #f0f8ff;">
                <h4>Total Jenis Barang</h4>
                <h2>{{ $totalBarang }}</h2>
            </td>
            <td style="background-color: #f5f5dc;">
                <h4>Total Kategori</h4>
                <h2>{{ $totalKategori }}</h2>
            </td>
            <td style="background-color: #e6ffe6;">
                <h4>Total Stok Barang</h4>
                <h2>{{ $totalStok }} Unit</h2>
            </td>
            <td style="background-color: #ffe6e6;">
                <h4>Laporan Kerusakan</h4>
                <h2>{{ $totalKerusakan }} Kasus</h2>
            </td>
        </tr>
    </table>

    <br>
    <hr>

    <!-- Section 2: Ringkasan Aktivitas Terbaru -->
    <table border="0" width="100%" cellpadding="10">
        <tr valign="top">
            <!-- Tabel Barang Terbaru -->
            <td width="50%">
                <h3>Barang Terbaru Ditambahkan</h3>
                <table border="1" cellpadding="6" cellspacing="0" width="100%">
                    <thead>
                        <tr style="background-color: #eee;">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangTerbaru as $b)
                            <tr>
                                <td>#{{ $loop->iteration }}</td>
                                <td><b>{{ $b->nama_barang }}</b></td>
                                <td>{{ $b->kategori->nama_kategori ?? '-' }}</td>
                                <td>Rp {{ number_format($b->harga_beli ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" align="center">Belum ada data barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <p><a href="{{ route('barang.index') }}">Lihat Semua Barang →</a></p>
            </td>

            <!-- Tabel Kerusakan Terbaru -->
            <td width="50%">
                <h3>Laporan Kerusakan Terbaru</h3>
                <table border="1" cellpadding="6" cellspacing="0" width="100%">
                    <thead>
                        <tr style="background-color: #eee;">
                            <th>No</th>
                            <th>Barang</th>
                            <th>Tingkat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kerusakanTerbaru as $k)
                            <tr>
                                <td>#{{ $loop->iteration }}</td>
                                <td><b>{{ $k->barang->nama_barang ?? 'Dihapus' }}</b></td>
                                <td>{{ $k->tingkat_kerusakan }}</td>
                                <td>
                                    @if($k->status == 'Pending')
                                        <span style="color: orange;"><b>Pending</b></span>
                                    @elseif($k->status == 'Diproses')
                                        <span style="color: blue;"><b>Diproses</b></span>
                                    @else
                                        <span style="color: green;"><b>Selesai</b></span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" align="center">Belum ada laporan kerusakan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <p><a href="{{ route('kerusakan.index') }}">Lihat Semua Laporan →</a></p>
            </td>
        </tr>
    </table>

</body>
</html>