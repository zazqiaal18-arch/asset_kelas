@extends('template.app')

@section('content')
<!-- Custom Styles -->
<style>
    :root {
        --inv-primary: #1e293b;
        --inv-accent: #3b82f6;
        --inv-bg: #f8fafc;
        --inv-card-bg: #ffffff;
        --inv-border: #e2e8f0;
        --inv-text-main: #334155;
        --inv-text-muted: #64748b;
    }

    body {
        background-color: var(--inv-bg);
        color: var(--inv-text-main);
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    /* Stats Widget */
    .stat-card {
        background: var(--inv-card-bg);
        border: 1px solid var(--inv-border);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Cards & Containers */
    .card-corporate {
        background: var(--inv-card-bg);
        border: 1px solid var(--inv-border);
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .card-corporate .card-header {
        background: transparent;
        border-bottom: 1px solid var(--inv-border);
        padding: 16px 20px;
        font-weight: 600;
        color: var(--inv-primary);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Table Styling */
    .table-corporate {
        margin-bottom: 0;
        width: 100%;
    }

    .table-corporate th {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        border-bottom: 1px solid var(--inv-border);
    }

    .table-corporate td {
        padding: 14px 16px;
        vertical-align: middle;
        border-bottom: 1px solid var(--inv-border);
        color: var(--inv-text-main);
        font-size: 0.875rem;
    }

    .table-corporate tbody tr:last-child td {
        border-bottom: none;
    }

    .table-corporate tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Badges */
    .badge-soft-success { background-color: #dcfce7; color: #166534; }
    .badge-soft-warning { background-color: #fef9c3; color: #854d0e; }
    .badge-soft-danger  { background-color: #fee2e2; color: #991b1b; }
    .badge-soft-info    { background-color: #e0f2fe; color: #075985; }

    /* Custom Scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
</style>

<div class="container-fluid py-4 px-3 px-md-4">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--inv-primary);">Dashboard Inventaris</h3>
            <p class="text-muted small mb-0">Ringkasan status barang dan laporan kerusakan terkini.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm rounded-pill">
                <i class="fas fa-plus me-1"></i> Tambah Barang
            </a>
            <a href="{{ route('kerusakan.create') }}" class="btn btn-outline-danger btn-sm px-3 shadow-sm rounded-pill ms-2">
                <i class="fas fa-exclamation-triangle me-1"></i> Lapor Kerusakan
            </a>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                    <i class="fas fa-boxes"></i>
                </div>
                <div>
                    <span class="text-muted small d-block">Total Jenis Barang</span>
                    <h4 class="fw-bold mb-0" style="color: var(--inv-primary);">{{ $totalBarang ?? 0 }}</h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon bg-info bg-opacity-10 text-info me-3">
                    <i class="fas fa-cubes"></i>
                </div>
                <div>
                    <span class="text-muted small d-block">Total Volume Unit</span>
                    <h4 class="fw-bold mb-0" style="color: var(--inv-primary);">{{ $totalUnitBarang ?? 0 }}</h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon bg-danger bg-opacity-10 text-danger me-3">
                    <i class="fas fa-tools"></i>
                </div>
                <div>
                    <span class="text-muted small d-block">Unit Rusak</span>
                    <h4 class="fw-bold mb-0" style="color: var(--inv-primary);">{{ $totalBarangRusak ?? 0 }}</h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                    <i class="fas fa-wallet"></i>
                </div>
                <div>
                    <span class="text-muted small d-block">Est. Nilai Aset</span>
                    <h4 class="fw-bold mb-0" style="color: var(--inv-primary);">
                        Rp {{ number_format($totalNilaiAset ?? 0, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="row g-4">
        <!-- Table List Barang -->
        <div class="col-12 col-lg-8">
            <div class="card-corporate h-100 mb-0">
                <div class="card-header">
                    <span><i class="fas fa-list text-muted me-2"></i>Daftar Master Barang</span>
                    <a href="{{ route('barang.index') }}" class="btn btn-sm btn-link text-decoration-none p-0">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-corporate align-middle">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th class="text-center">Jumlah</th>
                                <th>Kondisi Utama</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangs as $barang)
                            <tr>
                                <td class="fw-semibold text-secondary">{{ $barang->kode_barang }}</td>
                                <td>
                                    <div class="fw-bold">{{ $barang->nama_barang }}</div>
                                    <small class="text-muted">{{ $barang->lokasi ?? 'Lokasi -' }}</small>
                                </td>
                                <td><span class="badge badge-soft-info px-2 py-1">{{ $barang->kategori }}</span></td>
                                <td class="text-center fw-bold">{{ $barang->jumlah }}</td>
                                <td>
                                    @if(($barang->jumlah_rusak ?? 0) > 0)
                                        <span class="badge badge-soft-warning px-2 py-1">Ada Rusak ({{ $barang->jumlah_rusak }})</span>
                                    @else
                                        <span class="badge badge-soft-success px-2 py-1">Baik</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('barang.edit', $barang->id_barang ?? $barang->id) }}" class="btn btn-light text-secondary" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('barang.destroy', $barang->id_barang ?? $barang->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light text-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data barang.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Widgets -->
        <div class="col-12 col-lg-4">
            <!-- Ringkasan Kerusakan Widget -->
            <div class="card-corporate mb-4">
                <div class="card-header">
                    <span><i class="fas fa-chart-pie text-muted me-2"></i>Tingkat Kerusakan</span>
                </div>
                <div class="card-body p-3">
                    <div style="height: 200px;" class="d-flex justify-content-center">
                        <canvas id="kerusakanChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Damage Reports Widget -->
            <div class="card-corporate mb-0">
                <div class="card-header">
                    <span><i class="fas fa-history text-muted me-2"></i>Laporan Kerusakan Terbaru</span>
                    <a href="{{ route('kerusakan.index') }}" class="btn btn-sm btn-link text-decoration-none p-0">Detail</a>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-bottom">
                        @forelse($recentKerusakan as $laporan)
                        <li class="list-group-item p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <span class="fw-bold text-dark small">{{ $laporan->barang->nama_barang ?? 'Barang Dihapus' }}</span>
                                <span class="badge {{ $laporan->tingkat_kerusakan == 'Berat' ? 'badge-soft-danger' : ($laporan->tingkat_kerusakan == 'Sedang' ? 'badge-soft-warning' : 'badge-soft-info') }}">
                                    {{ $laporan->tingkat_kerusakan }}
                                </span>
                            </div>
                            <p class="text-muted small mb-1 text-truncate" style="max-width: 250px;">
                                {{ $laporan->deskripsi_kerusakan }}
                            </p>
                            <small class="text-secondary" style="font-size: 0.75rem;">
                                <i class="far fa-clock me-1"></i>{{ $laporan->created_at ? $laporan->created_at->diffForHumans() : '-' }}
                            </small>
                        </li>
                        @empty
                        <li class="list-group-item p-3 text-center text-muted small">
                            Tidak ada laporan kerusakan terbaru.
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('kerusakanChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
    labels: ['Ringan', 'Sedang', 'Berat'],
    datasets: [{
        data: [
            @json($kerusakanRingan ?? 0),
            @json($kerusakanSedang ?? 0),
            @json($kerusakanBerat ?? 0)
        ],
        backgroundColor: [
            '#38bdf8',
            '#facc15',
            '#f87171'
        ],
        borderWidth: 2,
        borderColor: '#ffffff'
    }]
}
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 15,
                            font: { size: 11 }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection