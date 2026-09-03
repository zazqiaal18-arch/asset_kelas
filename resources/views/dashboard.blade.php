@extends('template.app')

@section('content')

<!-- Custom Styles -->
<style>
    :root {
        --inv-primary: var(--admin-text);
        --inv-accent: var(--admin-primary);
        --inv-bg: var(--admin-bg);
        --inv-card-bg: var(--admin-surface);
        --inv-border: var(--admin-border);
        --inv-text-main: var(--admin-text);
        --inv-text-muted: var(--admin-muted);
    }

    body {
        background: var(--inv-bg);
        color: #000000;
        font-family: "Segoe UI", Arial, sans-serif;
    }

    .dashboard-page,
    .dashboard-page .card-corporate,
    .dashboard-page .stat-card,
    .dashboard-page .table-responsive,
    .dashboard-page .list-group-item {
        background: #ffffff;
        color: #000000;
    }

    .dashboard-page h1,
    .dashboard-page h2,
    .dashboard-page h3,
    .dashboard-page h4,
    .dashboard-page h5,
    .dashboard-page h6,
    .dashboard-page p,
    .dashboard-page span,
    .dashboard-page td,
    .dashboard-page th,
    .dashboard-page strong,
    .dashboard-page .text-dark,
    .dashboard-page .text-secondary,
    .dashboard-page .text-muted {
        color: #000000 !important;
    }

    .dashboard-page .card-header,
    .dashboard-page .table-corporate th {
        background: #ffffff;
        color: #000000 !important;
        border-color: #d1d5db;
    }

    .dashboard-page .table-corporate td {
        color: #000000 !important;
        border-color: #e5e7eb;
    }

    .dashboard-page .table-corporate tbody tr:hover {
        background: #f8fafc;
    }

    .dashboard-page .stat-icon,
    .dashboard-page .badge-soft-success,
    .dashboard-page .badge-soft-warning,
    .dashboard-page .badge-soft-danger,
    .dashboard-page .badge-soft-info {
        background: #eef7fd !important;
        color: #2980b9 !important;
    }

    .dashboard-page .btn-outline-danger {
        border-color: #b9d9ee;
        color: #2980b9;
    }

    .dashboard-page .btn-outline-danger:hover,
    .dashboard-page .btn-outline-danger:focus {
        background: #eef7fd;
        border-color: #8fc5e5;
        color: #2980b9;
    }

    /* Stats Widget */
    .stat-card {
        background: var(--inv-card-bg);
        border: 1px solid var(--inv-border);
        border-radius: 16px;
        padding: 20px;
        box-shadow: var(--admin-shadow-sm);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--admin-shadow);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    /* Cards & Containers */
    .card-corporate {
        background: var(--inv-card-bg);
        border: 1px solid var(--inv-border);
        border-radius: 16px;
        box-shadow: var(--admin-shadow-sm);
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
        background-color: var(--admin-surface-soft);
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        border-bottom: 1px solid var(--inv-border);
        white-space: nowrap;
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
        background-color: #f8fbff;
    }

    /* Badges */
    .badge-soft-success {
        background-color: #eef7fd;
        color: #2980b9;
    }

    .badge-soft-warning {
        background-color: #f3f8fc;
        color: #4b6b80;
    }

    .badge-soft-danger {
        background-color: #edf2f6;
        color: #405568;
    }

    .badge-soft-info {
        background-color: #eef7fd;
        color: #2980b9;
    }

    /* Custom Scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Chart */
    #kerusakanChart {
        max-width: 100%;
        max-height: 200px;
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .stat-card {
            padding: 16px;
        }

        .card-corporate .card-header {
            padding: 14px 16px;
        }

        .table-corporate th,
        .table-corporate td {
            padding: 12px;
        }
    }
</style>

<div class="dashboard-page container-fluid py-4 px-3 px-md-4">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--inv-primary);">
                Dashboard Inventaris
            </h3>

            <p class="text-muted small mb-0">
                Ringkasan status barang dan laporan kerusakan terkini.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <a href="{{ route('barang.create') }}"
               class="btn btn-primary btn-sm px-3 shadow-sm rounded-pill">
                <i class="fas fa-plus me-1"></i>
                Tambah Barang
            </a>

            <a href="{{ route('kerusakan.create') }}"
               class="btn btn-outline-danger btn-sm px-3 shadow-sm rounded-pill ms-2">
                <i class="fas fa-exclamation-triangle me-1"></i>
                Lapor Kerusakan
            </a>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="row g-3 mb-4">

        <!-- Total Jenis Barang -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card d-flex align-items-center">

                <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                    <i class="fas fa-boxes"></i>
                </div>

                <div>
                    <span class="text-muted small d-block">
                        Total Jenis Barang
                    </span>

                    <h4 class="fw-bold mb-0"
                        style="color: var(--inv-primary);">
                        {{ $totalBarang ?? 0 }}
                    </h4>
                </div>

            </div>
        </div>

        <!-- Total Unit -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card d-flex align-items-center">

                <div class="stat-icon bg-info bg-opacity-10 text-info me-3">
                    <i class="fas fa-cubes"></i>
                </div>

                <div>
                    <span class="text-muted small d-block">
                        Total Volume Unit
                    </span>

                    <h4 class="fw-bold mb-0"
                        style="color: var(--inv-primary);">
                        {{ $totalUnitBarang ?? 0 }}
                    </h4>
                </div>

            </div>
        </div>

        <!-- Barang Rusak -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card d-flex align-items-center">

                <div class="stat-icon bg-danger bg-opacity-10 text-danger me-3">
                    <i class="fas fa-tools"></i>
                </div>

                <div>
                    <span class="text-muted small d-block">
                        Unit Rusak
                    </span>

                    <h4 class="fw-bold mb-0"
                        style="color: var(--inv-primary);">
                        {{ $totalBarangRusak ?? 0 }}
                    </h4>
                </div>

            </div>
        </div>

        <!-- Nilai Aset -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card d-flex align-items-center">

                <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                    <i class="fas fa-wallet"></i>
                </div>

                <div>
                    <span class="text-muted small d-block">
                        Est. Nilai Aset
                    </span>

                    <h4 class="fw-bold mb-0"
                        style="color: var(--inv-primary);">
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

                    <span>
                        <i class="fas fa-list text-muted me-2"></i>
                        Daftar Master Barang
                    </span>

                    <a href="{{ route('barang.index') }}"
                       class="btn btn-sm btn-link text-decoration-none p-0">
                        Lihat Semua
                    </a>

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

                            @forelse($barangs ?? [] as $barang)

                                <tr>

                                    <!-- Kode -->
                                    <td class="fw-semibold text-secondary">
                                        {{ $barang->kode_barang ?? '-' }}
                                    </td>

                                    <!-- Nama -->
                                    <td>

                                        <div class="fw-bold">
                                            {{ $barang->nama_barang ?? '-' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $barang->lokasi ?? 'Lokasi -' }}
                                        </small>

                                    </td>

                                    <!-- Kategori -->
                                    <td>
                                        <span class="badge badge-soft-info px-2 py-1">
                                            {{ $barang->kategori ?? '-' }}
                                        </span>
                                    </td>

                                    <!-- Jumlah -->
                                    <td class="text-center fw-bold">
                                        {{ $barang->jumlah ?? 0 }}
                                    </td>

                                    <!-- Kondisi -->
                                    <td>

                                        @if(($barang->jumlah_rusak ?? 0) > 0)

                                            <span class="badge badge-soft-warning px-2 py-1">
                                                Ada Rusak
                                                ({{ $barang->jumlah_rusak }})
                                            </span>

                                        @else

                                            <span class="badge badge-soft-success px-2 py-1">
                                                Baik
                                            </span>

                                        @endif

                                    </td>

                                    <!-- Aksi -->
                                    <td class="text-end">

                                        @php
                                            $barangId = $barang->id_barang ?? $barang->id ?? null;
                                        @endphp

                                        @if($barangId)

                                            <div class="btn-group btn-group-sm">

                                                <!-- Edit -->
                                                <a href="{{ route('barang.edit', $barangId) }}"
                                                   class="btn btn-light text-secondary"
                                                   title="Edit">

                                                    <i class="fas fa-pencil-alt"></i>

                                                </a>

                                                <!-- Delete -->
                                                <form action="{{ route('barang.destroy', $barangId) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Hapus data ini?')"
                                                      class="d-inline">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-light text-danger"
                                                            title="Hapus">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        @else

                                            <span class="text-muted small">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6"
                                        class="text-center py-4 text-muted">

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

            <!-- Ringkasan Kerusakan -->
            <div class="card-corporate mb-4">

                <div class="card-header">

                    <span>
                        <i class="fas fa-chart-pie text-muted me-2"></i>
                        Tingkat Kerusakan
                    </span>

                </div>

                <div class="card-body p-3">

                    <div style="height: 200px;"
                         class="d-flex justify-content-center">

                        <canvas id="kerusakanChart"></canvas>

                    </div>

                </div>

            </div>

            <!-- Recent Damage Reports -->
            <div class="card-corporate mb-0">

                <div class="card-header">

                    <span>
                        <i class="fas fa-history text-muted me-2"></i>
                        Laporan Kerusakan Terbaru
                    </span>

                    <a href="{{ route('kerusakan.index') }}"
                       class="btn btn-sm btn-link text-decoration-none p-0">
                        Detail
                    </a>

                </div>

                <div class="card-body p-0">

                    <ul class="list-group list-group-flush rounded-bottom">

                        @forelse($recentKerusakan ?? [] as $laporan)

                            <li class="list-group-item p-3 border-bottom">

                                <div class="d-flex justify-content-between align-items-start mb-1">

                                    <span class="fw-bold text-dark small">

                                        {{ optional($laporan->barang)->nama_barang ?? 'Barang Dihapus' }}

                                    </span>

                                    @php
                                        $tingkat = $laporan->tingkat_kerusakan ?? 'Ringan';
                                    @endphp

                                    <span class="badge
                                        {{ $tingkat == 'Berat'
                                            ? 'badge-soft-danger'
                                            : ($tingkat == 'Sedang'
                                                ? 'badge-soft-warning'
                                                : 'badge-soft-info') }}">

                                        {{ $tingkat }}

                                    </span>

                                </div>

                                <p class="text-muted small mb-1 text-truncate"
                                   style="max-width: 250px;">

                                    {{ $laporan->deskripsi_kerusakan ?? '-' }}

                                </p>

                                <small class="text-secondary"
                                       style="font-size: 0.75rem;">

                                    <i class="far fa-clock me-1"></i>

                                    {{ $laporan->created_at
                                        ? $laporan->created_at->diffForHumans()
                                        : '-' }}

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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('kerusakanChart');
    
    // Pastikan canvas tersedia
    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');

    // Menggunakan Number() untuk memastikan output berupa angka
    const kerusakanRingan = Number("{{ $kerusakanRingan ?? 0 }}");
    const kerusakanSedang = Number("{{ $kerusakanSedang ?? 0 }}");
    const kerusakanBerat = Number("{{ $kerusakanBerat ?? 0 }}");
    
    const totalData = kerusakanRingan + kerusakanSedang + kerusakanBerat;

    // Jika tidak ada data, tampilkan pesan
    if (totalData === 0) {
        // Tampilkan pesan di canvas
        const parent = canvas.parentElement;
        parent.style.position = 'relative';
        
        const emptyMessage = document.createElement('div');
        emptyMessage.style.position = 'absolute';
        emptyMessage.style.top = '50%';
        emptyMessage.style.left = '50%';
        emptyMessage.style.transform = 'translate(-50%, -50%)';
        emptyMessage.style.color = '#94a3b8';
        emptyMessage.style.fontSize = '14px';
        emptyMessage.style.textAlign = 'center';
        emptyMessage.style.pointerEvents = 'none';
        emptyMessage.innerHTML = `
            <i class="fas fa-chart-pie fa-2x d-block mb-2"></i>
            Belum ada data kerusakan
        `;
        parent.appendChild(emptyMessage);
        
        // Buat chart dengan data dummy agar tidak error
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Ringan', 'Sedang', 'Berat'],
                datasets: [{
                    data: [1, 1, 1],
                    backgroundColor: ['#e2e8f0', '#e2e8f0', '#e2e8f0'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                }
            }
        });
        return;
    }

    // Buat chart seperti biasa
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Ringan', 'Sedang', 'Berat'],
            datasets: [{
                data: [kerusakanRingan, kerusakanSedang, kerusakanBerat],
                backgroundColor: ['#8fc5e5', '#b9d9ee', '#5b9bd5'],
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 15,
                        font: {
                            size: 11,
                            weight: '600'
                        },
                        color: '#334155'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                            return label + ': ' + value + ' unit (' + percentage + '%)';
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                duration: 1000
            }
        }
    });
});
</script>
@endsection
