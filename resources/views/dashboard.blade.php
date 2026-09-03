@extends('template.app')

@section('title', 'Dashboard Inventaris')

@section('content')
<!-- Custom Style untuk Tampilan Elegan Kantoran -->
<style>
    :root {
        --inv-primary: #1e293b;
        --inv-accent: #3b82f6;
        --inv-bg: #f8fafc;
        --inv-card-border: #e2e8f0;
    }
    
    body {
        background-color: var(--inv-bg);
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid var(--inv-card-border);
        border-radius: 12px;
        transition: all 0.25s ease-in-out;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
    }

    .icon-shape {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
    }

    .bg-soft-primary { background-color: #eff6ff; color: #2563eb; }
    .bg-soft-success { background-color: #f0fdf4; color: #16a34a; }
    .bg-soft-danger  { background-color: #fef2f2; color: #dc2626; }
    .bg-soft-info    { background-color: #f0f9ff; color: #0284c7; }

    .card-corporate {
        border: 1px solid var(--inv-card-border);
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        background: #ffffff;
    }

    .card-corporate .card-header {
        background-color: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem;
    }

    .table-corporate th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        color: #64748b;
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 0.85rem 1rem;
    }

    .table-corporate td {
        padding: 1rem 1rem;
        color: #334155;
        font-size: 0.875rem;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Soft Badges */
    .badge-soft-warning { background-color: #fef3c7; color: #d97706; font-weight: 600; }
    .badge-soft-orange  { background-color: #ffedd5; color: #ea580c; font-weight: 600; }
    .badge-soft-danger  { background-color: #fee2e2; color: #dc2626; font-weight: 600; }
    .badge-soft-info    { background-color: #e0f2fe; color: #0369a1; font-weight: 600; }

    .btn-corporate-primary {
        background-color: #0f172a;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.1rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-corporate-primary:hover {
        background-color: #1e293b;
        color: #ffffff;
    }

    .btn-corporate-danger {
        background-color: #ef4444;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.1rem;
        font-weight: 500;
    }
    .btn-corporate-danger:hover {
        background-color: #dc2626;
        color: #ffffff;
    }
</style>

<div class="container-fluid px-4 py-4">
    
    <!-- Title & Action Bar -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-slate-800 m-0" style="color: #0f172a;">Dashboard Management Aset</h3>
            <p class="text-muted mb-0 small">Ringkasan real-time inventaris, tingkat kerusakan, dan valuasi aset kantor.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('barang.create') }}" class="btn btn-corporate-primary shadow-sm">
                <i class="fas fa-plus me-1.5 fs-7"></i> Tambah Barang
            </a>
            <a href="{{ route('kerusakan.create') }}" class="btn btn-corporate-danger shadow-sm">
                <i class="fas fa-exclamation-triangle me-1.5 fs-7"></i> Lapor Rusak
            </a>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="row g-3 mb-4">
        <!-- Jenis Barang -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fw-semibold text-uppercase fs-7 d-block mb-1">Total Jenis Barang</span>
                        <h3 class="fw-bold text-dark mb-0">
                            {{ $totalBarang ?? (isset($barangs) ? $barangs->count() : 0) }}
                        </h3>
                        <span class="text-muted fs-8">Kategori Terdaftar</span>
                    </div>
                    <div class="icon-shape bg-soft-primary">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Fisik Unit -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fw-semibold text-uppercase fs-7 d-block mb-1">Total Fisik Stok</span>
                        <h3 class="fw-bold text-dark mb-0">
                            {{ $totalUnitBarang ?? (isset($barangs) ? $barangs->sum('jumlah') : 0) }}
                        </h3>
                        <span class="text-muted fs-8">Unit Tersedia</span>
                    </div>
                    <div class="icon-shape bg-soft-success">
                        <i class="fas fa-cubes"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit Rusak -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fw-semibold text-uppercase fs-7 d-block mb-1">Unit Rusak</span>
                        <h3 class="fw-bold text-dark mb-0">
                            {{ $totalBarangRusak ?? 0 }}
                        </h3>
                        <span class="text-muted fs-8">Membutuhkan Tindakan</span>
                    </div>
                    <div class="icon-shape bg-soft-danger">
                        <i class="fas fa-tools"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estimasi Sisa Nilai Aset -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fw-semibold text-uppercase fs-7 d-block mb-1">Valuasi Aset</span>
                        <h4 class="fw-bold text-dark mb-0">
                            Rp {{ number_format($totalNilaiAset ?? 0, 0, ',', '.') }}
                        </h4>
                        <span class="text-muted fs-8">Estimasi Total Nilai</span>
                    </div>
                    <div class="icon-shape bg-soft-info">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Diagram & Laporan Kerusakan -->
    <div class="row g-4 mb-4">
        @php
            $kRingan = $kerusakanRingan ?? 0;
            $kSedang = $kerusakanSedang ?? 0;
            $kBerat  = $kerusakanBerat ?? 0;
            $totalKerusakan = $kRingan + $kSedang + $kBerat;
        @endphp

        <!-- Diagram Kerusakan -->
        <div class="col-lg-4">
            <div class="card card-corporate h-100">
                <div class="card-header">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-chart-pie me-2 text-primary"></i>Statistik Kondisi Aset
                    </h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center" style="min-height: 280px;">
                    @if($totalKerusakan > 0)
                        <div style="position: relative; width: 100%; height: 220px;">
                            <canvas id="kerusakanChart"></canvas>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <div class="icon-shape bg-soft-success mx-auto mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-check-circle fs-3"></i>
                            </div>
                            <h6 class="fw-bold text-dark">Semua Aset Aman</h6>
                            <p class="small text-muted mb-0">Tidak ada catatan kerusakan barang saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tabel Ringkasan Laporan Kerusakan Terbaru -->
        <div class="col-lg-8">
            <div class="card card-corporate h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-exclamation-circle me-2 text-danger"></i>Laporan Kerusakan Terkini
                    </h6>
                    <a href="{{ route('kerusakan.index') }}" class="btn btn-sm btn-light border text-secondary fw-medium">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-corporate align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tingkat</th>
                                    <th>Deskripsi Kendala</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentKerusakan ?? [] as $rusak)
                                    <tr>
                                        <td class="fw-bold text-dark">{{ $rusak->barang->nama_barang ?? 'Barang Dihapus' }}</td>
                                        <td>{{ $rusak->jumlah_rusak }} Unit</td>
                                        <td>
                                            @if(($rusak->tingkat_kerusakan ?? '') == 'Ringan')
                                                <span class="badge badge-soft-warning px-2.5 py-1.5 rounded-pill">Ringan</span>
                                            @elseif(($rusak->tingkat_kerusakan ?? '') == 'Sedang')
                                                <span class="badge badge-soft-orange px-2.5 py-1.5 rounded-pill">Sedang</span>
                                            @else
                                                <span class="badge badge-soft-danger px-2.5 py-1.5 rounded-pill">Berat</span>
                                            @endif
                                        </td>
                                        <td class="text-muted text-truncate" style="max-width: 250px;">{{ $rusak->deskripsi_kerusakan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada laporan kerusakan baru.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Index Data Barang -->
    <div class="card card-corporate">
        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fas fa-boxes me-2 text-primary"></i>Daftar Inventaris Barang
                </h6>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('barang.index') }}" class="btn btn-sm btn-light border text-secondary fw-medium">
                    <i class="fas fa-external-link-alt me-1"></i> Kelola Kelola Semua
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-corporate align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th>Barang</th>
                            <th>Stok Tersedia</th>
                            <th>Tanggal Beli</th>
                            <th>Harga Satuan</th>
                            <th class="text-end" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs ?? [] as $key => $item)
                            <tr>
                                <td class="text-center text-muted fs-7">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-shape bg-light text-secondary me-2.5" style="width:36px; height:36px; font-size: 0.9rem;">
                                            <i class="fas fa-box"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $item->nama_barang }}</span>
                                            <span class="text-muted fs-8">Kode: {{ $item->kode_barang ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-soft-info px-2.5 py-1.5 rounded-pill">
                                        {{ $item->jumlah }} Unit
                                    </span>
                                </td>
                                <td>{{ $item->tanggal_beli ? \Carbon\Carbon::parse($item->tanggal_beli)->format('d M Y') : '-' }}</td>
                                <td class="fw-medium text-dark">
                                    {{ $item->harga_beli ? 'Rp ' . number_format($item->harga_beli, 0, ',', '.') : '-' }}
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('barang.edit', $item->id ?? 1) }}" class="btn btn-light border" title="Edit Data">
                                            <i class="fas fa-edit text-secondary"></i>
                                        </a>
                                        <form action="{{ route('barang.destroy', $item->id ?? 1) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light border" title="Hapus Barang">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-2x mb-2 opacity-50"></i>
                                    <p class="mb-0">Belum ada data barang yang dicatat.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const totalKerusakan = {{ $totalKerusakan }};
        
        if (totalKerusakan > 0) {
            const ctx = document.getElementById('kerusakanChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Ringan', 'Sedang', 'Berat'],
                    datasets: [{
                        data: [
                            {{ $kRingan }},
                            {{ $kSedang }},
                            {{ $kBerat }}
                        ],
                        backgroundColor: [
                            '#f59e0b', // Amber / Warning
                            '#f97316', // Orange
                            '#ef4444'  // Red / Danger
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        }
    });
</script>
@endsection