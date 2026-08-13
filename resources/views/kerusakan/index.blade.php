@extends('template.app')

@section('title', 'Data Kerusakan Barang')

@section('content')
<div class="container-fluid px-0">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1 theme-text-primary">Laporan Kerusakan Barang</h3>
      <p class="mb-0 theme-text-secondary">Daftar seluruh laporan kerusakan barang / aset kelas.</p>
    </div>
    <a href="{{ route('kerusakan.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> Laporkan Kerusakan Baru
    </a>
  </div>

  <!-- Alert Success -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      <strong>Berhasil!</strong> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Table Card -->
  <div class="card border-0 theme-card shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table theme-table table-hover align-middle mb-0">
          <thead>
            <tr class="border-bottom theme-border">
              <th scope="col" class="ps-4 theme-text-secondary" style="width: 50px;">NO</th>
              <th scope="col" class="theme-text-secondary">NAMA BARANG</th>
              <th scope="col" class="theme-text-secondary text-center">JUMLAH RUSAK</th>
              <th scope="col" class="theme-text-secondary text-center">TINGKAT</th>
              <th scope="col" class="theme-text-secondary">DESKRIPSI</th>
              <th scope="col" class="text-end pe-4 theme-text-secondary" style="width: 200px;">AKSI</th>
            </tr>
          </thead>
          <tbody>
            @forelse($kerusakans as $item)
              <tr class="border-bottom theme-border">
                <td class="ps-4 fw-semibold theme-text-secondary">{{ $loop->iteration }}</td>
                <td class="fw-bold theme-text-primary">
                  {{ $item->barang->nama_barang ?? 'Barang Dihapus' }}
                </td>
                <td class="text-center">
                  <span class="badge theme-badge-jumlah">{{ $item->jumlah_rusak }}</span>
                </td>
                <td class="text-center">
                  @php
                    $badgeClass = '';
                    $icon = '';
                    if($item->tingkat_kerusakan == 'Ringan') {
                      $badgeClass = 'badge-tingkat-ringan';
                      $icon = '🟢';
                    } elseif($item->tingkat_kerusakan == 'Sedang') {
                      $badgeClass = 'badge-tingkat-sedang';
                      $icon = '🟡';
                    } else {
                      $badgeClass = 'badge-tingkat-berat';
                      $icon = '🔴';
                    }
                  @endphp
                  <span class="badge {{ $badgeClass }}">
                    {{ $icon }} {{ $item->tingkat_kerusakan }}
                  </span>
                </td>
                <td class="theme-text-secondary">
                  {{ Str::limit($item->deskripsi_kerusakan, 50) }}
                </td>
                <td class="text-end pe-4">
                  <a href="{{ route('kerusakan.edit', $item->id_kerusakan) }}" class="btn btn-warning btn-sm me-1 fw-bold">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  
                  <form action="{{ route('kerusakan.destroy', $item->id_kerusakan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus laporan kerusakan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-4 theme-text-secondary">
                  <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                  Belum ada laporan kerusakan.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Total Laporan -->
  @if($kerusakans->count() > 0)
    <div class="mt-3 theme-text-secondary">
      <small>Total Laporan: <strong class="theme-text-primary">{{ $kerusakans->count() }}</strong> items</small>
    </div>
  @endif

</div>
@endsection

@push('styles')
<style>
/* ===== DARK/LIGHT MODE VARIABLES ===== */
:root {
  /* Light Mode */
  --theme-bg-body: #f0f2f5;
  --theme-bg-card: #ffffff;
  --theme-text-primary: #1a1a2e;
  --theme-text-secondary: #6c757d;
  --theme-border-color: #dee2e6;
  --theme-card-shadow: rgba(0, 0, 0, 0.08);
  --theme-badge-bg: #0d6efd;
  --theme-badge-text: #ffffff;
}

[data-bs-theme="dark"] {
  /* Dark Mode */
  --theme-bg-body: #0d0d1a;
  --theme-bg-card: #ffffff;
  --theme-text-primary: #1a1a2e;
  --theme-text-secondary: #6c757d;
  --theme-border-color: #dee2e6;
  --theme-card-shadow: rgba(0, 0, 0, 0.15);
  --theme-badge-bg: #0d6efd;
  --theme-badge-text: #ffffff;
}

/* ===== BODY ===== */
body {
  background-color: var(--theme-bg-body);
  color: var(--theme-text-primary);
  transition: background-color 0.3s ease, color 0.3s ease;
}

/* ===== CARD - PUTIH DI KEDUA MODE ===== */
.theme-card {
  background-color: #ffffff !important;
  border: 1px solid var(--theme-border-color) !important;
  transition: background-color 0.3s ease, border-color 0.3s ease;
  box-shadow: 0 2px 12px var(--theme-card-shadow) !important;
}

/* ===== TABLE ===== */
.theme-table {
  background-color: #ffffff !important;
  color: var(--theme-text-primary) !important;
}

.theme-table tbody tr:hover {
  background-color: #f8f9fa !important;
}

[data-bs-theme="dark"] .theme-table tbody tr:hover {
  background-color: #f0f0f0 !important;
}

.theme-text-primary {
  color: var(--theme-text-primary) !important;
  transition: color 0.3s ease;
}

.theme-text-secondary {
  color: var(--theme-text-secondary) !important;
  transition: color 0.3s ease;
}

.theme-border {
  border-color: var(--theme-border-color) !important;
  transition: border-color 0.3s ease;
}

/* ===== BADGE JUMLAH ===== */
.theme-badge-jumlah {
  background-color: var(--theme-badge-bg) !important;
  color: var(--theme-badge-text) !important;
  padding: 0.4rem 0.8rem !important;
  font-size: 0.85rem !important;
  font-weight: 600 !important;
  border-radius: 0.5rem !important;
  display: inline-block !important;
  min-width: 35px !important;
  transition: background-color 0.3s ease, color 0.3s ease;
}

/* ===== BADGE TINGKAT KERUSAKAN ===== */
.badge-tingkat-ringan {
  background-color: #d4edda !important;
  color: #155724 !important;
  padding: 0.4rem 0.8rem !important;
  font-size: 0.85rem !important;
  font-weight: 600 !important;
  border-radius: 0.5rem !important;
}

.badge-tingkat-sedang {
  background-color: #fff3cd !important;
  color: #856404 !important;
  padding: 0.4rem 0.8rem !important;
  font-size: 0.85rem !important;
  font-weight: 600 !important;
  border-radius: 0.5rem !important;
}

.badge-tingkat-berat {
  background-color: #f8d7da !important;
  color: #721c24 !important;
  padding: 0.4rem 0.8rem !important;
  font-size: 0.85rem !important;
  font-weight: 600 !important;
  border-radius: 0.5rem !important;
}

[data-bs-theme="dark"] .badge-tingkat-ringan {
  background-color: #1e3a2a !important;
  color: #8fdf9f !important;
}

[data-bs-theme="dark"] .badge-tingkat-sedang {
  background-color: #3d3a1a !important;
  color: #f5d742 !important;
}

[data-bs-theme="dark"] .badge-tingkat-berat {
  background-color: #3a1a1a !important;
  color: #f58a8a !important;
}

/* ===== BUTTONS ===== */
.btn-warning {
  background-color: #ffc107 !important;
  border-color: #ffc107 !important;
  transition: all 0.3s ease;
  font-weight: 600;
  color: #1a1a2e !important;
}

.btn-warning:hover {
  background-color: #e0a800 !important;
  border-color: #d39e00 !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4) !important;
}

.btn-danger {
  background-color: #dc3545 !important;
  border-color: #dc3545 !important;
  transition: all 0.3s ease;
  font-weight: 600;
  color: #ffffff !important;
}

.btn-danger:hover {
  background-color: #c82333 !important;
  border-color: #bd2130 !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4) !important;
}

.btn-primary {
  background-color: #0d6efd !important;
  border-color: #0d6efd !important;
  transition: all 0.3s ease;
  font-weight: 600;
  padding: 0.6rem 1.5rem !important;
  border-radius: 0.5rem !important;
  color: #ffffff !important;
}

.btn-primary:hover {
  background-color: #0b5ed7 !important;
  border-color: #0a58ca !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4) !important;
}

/* ===== ALERT ===== */
.alert-success {
  border-radius: 0.5rem !important;
  background-color: #198754 !important;
  color: #ffffff !important;
  border: none !important;
}

.alert-success .btn-close {
  filter: brightness(0) invert(1);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .table td, .table th {
    padding: 0.5rem !important;
  }
  
  .btn-sm {
    padding: 0.2rem 0.5rem !important;
    font-size: 0.7rem !important;
  }
  
  .theme-badge-jumlah,
  .badge-tingkat-ringan,
  .badge-tingkat-sedang,
  .badge-tingkat-berat {
    padding: 0.3rem 0.6rem !important;
    font-size: 0.75rem !important;
  }
  
  .d-flex.justify-content-between {
    flex-direction: column;
    align-items: flex-start !important;
    gap: 0.5rem;
  }
  
  .text-end {
    text-align: left !important;
  }
  
  .text-end.pe-4 {
    padding-right: 0.5rem !important;
    padding-left: 0.5rem !important;
  }
}

@media (max-width: 576px) {
  .container-fluid {
    padding-left: 0.75rem !important;
    padding-right: 0.75rem !important;
  }
  
  .table td, .table th {
    padding: 0.4rem !important;
    font-size: 0.75rem !important;
  }
  
  .btn-sm {
    padding: 0.15rem 0.3rem !important;
    font-size: 0.65rem !important;
  }
  
  .theme-badge-jumlah,
  .badge-tingkat-ringan,
  .badge-tingkat-sedang,
  .badge-tingkat-berat {
    padding: 0.2rem 0.4rem !important;
    font-size: 0.65rem !important;
  }
}

/* ===== SMOOTH TRANSITION ===== */
* {
  transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
}

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: var(--theme-bg-body);
}

::-webkit-scrollbar-thumb {
  background: var(--theme-border-color);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--theme-text-secondary);
}

/* ===== SELECTION ===== */
::selection {
  background-color: #0d6efd;
  color: #ffffff;
}

/* ===== LINK ===== */
a {
  text-decoration: none;
  transition: color 0.3s ease;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-bs-theme', savedTheme);
    
    // Update icon if exists
    updateThemeIcon();
});

// Function to toggle theme
function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-bs-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcon();
}

// Update theme icon
function updateThemeIcon() {
    const theme = document.documentElement.getAttribute('data-bs-theme');
    const icon = document.getElementById('themeIcon');
    if (icon) {
        if (theme === 'dark') {
            icon.className = 'bi bi-sun-fill';
            icon.title = 'Switch to Light Mode';
        } else {
            icon.className = 'bi bi-moon-fill';
            icon.title = 'Switch to Dark Mode';
        }
    }
}

// Auto-detect system preference
if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    if (!localStorage.getItem('theme')) {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
}
</script>
@endpush