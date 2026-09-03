{{-- resources/views/kerusakan/show.blade.php --}}
@extends('template.app')

@section('content')
<style>
    .detail-container {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        max-width: 900px;
        margin: 0 auto;
        overflow: hidden;
    }

    .detail-header {
        background: #f8fafc;
        padding: 24px 32px;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-body {
        padding: 32px;
    }

    .info-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        width: 160px;
        font-weight: 600;
        color: #64748b;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .info-value {
        flex: 1;
        color: #1e293b;
        font-weight: 500;
    }

    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .status-badge.menunggu { background: #fef9c3; color: #854d0e; }
    .status-badge.proses { background: #dbeafe; color: #1e40af; }
    .status-badge.selesai { background: #dcfce7; color: #166534; }

    .tingkat-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .tingkat-badge.ringan { background: #e0f2fe; color: #075985; }
    .tingkat-badge.sedang { background: #fef9c3; color: #854d0e; }
    .tingkat-badge.berat { background: #fee2e2; color: #991b1b; }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
</style>

<div class="container-fluid py-4 px-3 px-md-4">
    <div class="detail-container">
        {{-- Header --}}
        <div class="detail-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0" style="color: #1e293b;">
                    <i class="fas fa-tools text-primary me-2"></i>Detail Laporan Kerusakan
                </h5>
                <span class="text-muted small">
                    ID: #{{ $kerusakan->id_kerusakan }}
                </span>
            </div>
            <div class="action-buttons">
                <a href="{{ route('kerusakan.edit', $kerusakan->id_kerusakan) }}"
                   class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="fas fa-pencil-alt me-1"></i> Edit
                </a>
                <a href="{{ route('kerusakan.index') }}"
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        {{-- Body --}}
        <div class="detail-body">
            {{-- Status & Tingkat --}}
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <small class="text-muted d-block">Status Penanganan</small>
                        <span class="status-badge {{ strtolower($kerusakan->status_penanganan ?? 'menunggu') }}">
                            {{ $kerusakan->status_penanganan ?? 'Menunggu' }}
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <small class="text-muted d-block">Tingkat Kerusakan</small>
                        <span class="tingkat-badge {{ strtolower($kerusakan->tingkat_kerusakan) }}">
                            {{ $kerusakan->tingkat_kerusakan }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Informasi Detail --}}
            <div class="info-row">
                <div class="info-label">Nama Barang</div>
                <div class="info-value">
                    {{ $kerusakan->barang->nama_barang ?? 'Barang Dihapus' }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Kode Barang</div>
                <div class="info-value">
                    {{ $kerusakan->barang->kode_barang ?? '-' }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Jumlah Rusak</div>
                <div class="info-value">
                    <span class="fw-bold">{{ $kerusakan->jumlah_rusak }}</span> unit
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Deskripsi</div>
                <div class="info-value">
                    {{ $kerusakan->deskripsi_kerusakan }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Tanggal Lapor</div>
                <div class="info-value">
                    {{ $kerusakan->created_at ? $kerusakan->created_at->translatedFormat('l, d F Y H:i') : '-' }}
                </div>
            </div>

            @if($kerusakan->updated_at && $kerusakan->updated_at != $kerusakan->created_at)
            <div class="info-row">
                <div class="info-label">Terakhir Update</div>
                <div class="info-value">
                    {{ $kerusakan->updated_at->translatedFormat('l, d F Y H:i') }}
                </div>
            </div>
            @endif

            {{-- Tombol Aksi --}}
            <div class="mt-4 pt-3 border-top d-flex gap-2 flex-wrap">
                <a href="{{ route('kerusakan.edit', $kerusakan->id_kerusakan) }}"
                   class="btn btn-primary btn-sm rounded-pill px-4">
                    <i class="fas fa-pencil-alt me-1"></i> Edit Laporan
                </a>
                <form action="{{ route('kerusakan.destroy', $kerusakan->id_kerusakan) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
