@extends('template.app')

@section('title', 'Edit Data Kerusakan')

@section('content')
<div class="container-fluid px-0">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1 theme-text-primary">Edit Laporan Kerusakan</h3>
      <p class="mb-0 theme-text-secondary">Edit data laporan kerusakan barang.</p>
    </div>
    <a href="{{ route('kerusakan.index') }}" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
  </div>

  <!-- Error Alert -->
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      <strong>Gagal!</strong> Mohon periksa kembali data yang Anda masukkan.
      <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Form Card -->
  <div class="card border-0 theme-card shadow-sm">
    <div class="card-body p-4">
      <form action="{{ route('kerusakan.update', $kerusakan->id_kerusakan) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilih Barang -->
        <div class="mb-4">
          <label for="barang_id" class="form-label fw-semibold theme-text-primary">
            <i class="bi bi-box me-1"></i> Pilih Barang
          </label>
          <select class="form-select theme-select @error('barang_id') is-invalid @enderror" 
                  id="barang_id" 
                  name="barang_id" 
                  required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barangs as $barang)
              <option value="{{ $barang->id_barang }}" {{ old('barang_id', $kerusakan->barang_id) == $barang->id_barang ? 'selected' : '' }}>
                {{ $barang->nama_barang }} (Stok: {{ $barang->jumlah }})
              </option>
            @endforeach
          </select>
          @error('barang_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Jumlah Rusak -->
        <div class="mb-4">
          <label for="jumlah_rusak" class="form-label fw-semibold theme-text-primary">
            <i class="bi bi-hash me-1"></i> Jumlah Rusak
          </label>
          <input type="number" 
                 class="form-control theme-input @error('jumlah_rusak') is-invalid @enderror" 
                 id="jumlah_rusak" 
                 name="jumlah_rusak" 
                 min="1" 
                 value="{{ old('jumlah_rusak', $kerusakan->jumlah_rusak) }}" 
                 placeholder="Masukkan jumlah barang yang rusak" 
                 required>
          @error('jumlah_rusak')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Tingkat Kerusakan -->
        <div class="mb-4">
          <label for="tingkat_kerusakan" class="form-label fw-semibold theme-text-primary">
            <i class="bi bi-exclamation-triangle me-1"></i> Tingkat Kerusakan
          </label>
          <select class="form-select theme-select @error('tingkat_kerusakan') is-invalid @enderror" 
                  id="tingkat_kerusakan" 
                  name="tingkat_kerusakan" 
                  required>
            <option value="Ringan" {{ old('tingkat_kerusakan', $kerusakan->tingkat_kerusakan) == 'Ringan' ? 'selected' : '' }}>🟢 Ringan</option>
            <option value="Sedang" {{ old('tingkat_kerusakan', $kerusakan->tingkat_kerusakan) == 'Sedang' ? 'selected' : '' }}>🟡 Sedang</option>
            <option value="Berat" {{ old('tingkat_kerusakan', $kerusakan->tingkat_kerusakan) == 'Berat' ? 'selected' : '' }}>🔴 Berat</option>
          </select>
          @error('tingkat_kerusakan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Deskripsi Kerusakan -->
        <div class="mb-4">
          <label for="deskripsi_kerusakan" class="form-label fw-semibold theme-text-primary">
            <i class="bi bi-file-text me-1"></i> Deskripsi Kerusakan
          </label>
          <textarea class="form-control theme-textarea @error('deskripsi_kerusakan') is-invalid @enderror" 
                    id="deskripsi_kerusakan" 
                    name="deskripsi_kerusakan" 
                    rows="4" 
                    placeholder="Jelaskan secara detail kerusakan yang terjadi" 
                    required>{{ old('deskripsi_kerusakan', $kerusakan->deskripsi_kerusakan) }}</textarea>
          @error('deskripsi_kerusakan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          <small class="theme-text-secondary">
            <i class="bi bi-info-circle me-1"></i>
            Deskripsi yang detail akan membantu proses perbaikan.
          </small>
        </div>

        <!-- Tombol Submit -->
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-lg me-1"></i> Update Laporan
          </button>
          <a href="{{ route('kerusakan.index') }}" class="btn btn-secondary px-4">
            <i class="bi bi-x-lg me-1"></i> Batal
          </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Informasi Tambahan -->
  <div class="mt-3 theme-text-secondary">
    <small>
      <i class="bi bi-info-circle me-1"></i>
      ID Laporan: <strong class="theme-text-primary">{{ $kerusakan->id_kerusakan }}</strong>
      &nbsp;|&nbsp; 
      Dibuat: <strong class="theme-text-primary">{{ $kerusakan->created_at ? $kerusakan->created_at->format('d-m-Y H:i') : '-' }}</strong>
      &nbsp;|&nbsp;
      Terakhir diupdate: <strong class="theme-text-primary">{{ $kerusakan->updated_at ? $kerusakan->updated_at->format('d-m-Y H:i') : '-' }}</strong>
    </small>
  </div>

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
  --theme-input-bg: #ffffff;
  --theme-input-border: #ced4da;
  --theme-input-focus: #0d6efd;
  --theme-input-shadow: rgba(13, 110, 253, 0.25);
  --theme-label-color: #1a1a2e;
  --theme-card-shadow: rgba(0, 0, 0, 0.08);
  --theme-placeholder: #6c757d;
  --theme-input-text: #1a1a2e;
  --theme-btn-secondary-bg: #e9ecef;
  --theme-btn-secondary-color: #1a1a2e;
  --theme-btn-secondary-border: #ced4da;
  --theme-select-bg: #ffffff;
  --theme-select-text: #1a1a2e;
  --theme-textarea-bg: #ffffff;
  --theme-textarea-text: #1a1a2e;
}

[data-bs-theme="dark"] {
  /* Dark Mode */
  --theme-bg-body: #0d0d1a;
  --theme-bg-card: #ffffff;
  --theme-text-primary: #1a1a2e;
  --theme-text-secondary: #6c757d;
  --theme-border-color: #dee2e6;
  --theme-input-bg: #ffffff;
  --theme-input-border: #ced4da;
  --theme-input-focus: #4d8cf7;
  --theme-input-shadow: rgba(77, 140, 247, 0.3);
  --theme-label-color: #1a1a2e;
  --theme-card-shadow: rgba(0, 0, 0, 0.15);
  --theme-placeholder: #6c757d;
  --theme-input-text: #1a1a2e;
  --theme-btn-secondary-bg: #e9ecef;
  --theme-btn-secondary-color: #1a1a2e;
  --theme-btn-secondary-border: #ced4da;
  --theme-select-bg: #ffffff;
  --theme-select-text: #1a1a2e;
  --theme-textarea-bg: #ffffff;
  --theme-textarea-text: #1a1a2e;
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

/* ===== TEXT ===== */
.theme-text-primary {
  color: var(--theme-text-primary) !important;
  transition: color 0.3s ease;
}

.theme-text-secondary {
  color: var(--theme-text-secondary) !important;
  transition: color 0.3s ease;
}

/* ===== FORM LABEL ===== */
.form-label {
  color: var(--theme-label-color) !important;
  transition: color 0.3s ease;
  font-weight: 600;
  font-size: 0.95rem;
}

/* ===== INPUT - PUTIH ===== */
.theme-input {
  background-color: #ffffff !important;
  color: #1a1a2e !important;
  border: 2px solid var(--theme-input-border) !important;
  transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
  padding: 0.7rem 1rem !important;
  border-radius: 0.5rem !important;
  font-size: 0.95rem !important;
  width: 100% !important;
}

.theme-input:focus {
  background-color: #ffffff !important;
  color: #1a1a2e !important;
  border-color: var(--theme-input-focus) !important;
  box-shadow: 0 0 0 0.25rem var(--theme-input-shadow) !important;
  outline: none !important;
}

.theme-input::placeholder {
  color: var(--theme-placeholder) !important;
  opacity: 0.6;
}

.theme-input.is-invalid {
  border-color: #dc3545 !important;
  box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
}

/* ===== SELECT - PUTIH ===== */
.theme-select {
  background-color: #ffffff !important;
  color: #1a1a2e !important;
  border: 2px solid var(--theme-input-border) !important;
  transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
  padding: 0.7rem 1rem !important;
  border-radius: 0.5rem !important;
  font-size: 0.95rem !important;
  width: 100% !important;
  cursor: pointer !important;
}

.theme-select:focus {
  background-color: #ffffff !important;
  color: #1a1a2e !important;
  border-color: var(--theme-input-focus) !important;
  box-shadow: 0 0 0 0.25rem var(--theme-input-shadow) !important;
  outline: none !important;
}

.theme-select.is-invalid {
  border-color: #dc3545 !important;
  box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
}

/* ===== TEXTAREA - PUTIH ===== */
.theme-textarea {
  background-color: #ffffff !important;
  color: #1a1a2e !important;
  border: 2px solid var(--theme-input-border) !important;
  transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
  padding: 0.7rem 1rem !important;
  border-radius: 0.5rem !important;
  font-size: 0.95rem !important;
  width: 100% !important;
  min-height: 120px !important;
  resize: vertical !important;
}

.theme-textarea:focus {
  background-color: #ffffff !important;
  color: #1a1a2e !important;
  border-color: var(--theme-input-focus) !important;
  box-shadow: 0 0 0 0.25rem var(--theme-input-shadow) !important;
  outline: none !important;
}

.theme-textarea::placeholder {
  color: var(--theme-placeholder) !important;
  opacity: 0.6;
}

.theme-textarea.is-invalid {
  border-color: #dc3545 !important;
  box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
}

/* ===== BUTTONS ===== */
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
  color: #ffffff !important;
}

.btn-primary:active {
  transform: translateY(0px) !important;
}

/* ===== BUTTON BATAL - LEBIH JELAS ===== */
.btn-secondary {
  background-color: var(--theme-btn-secondary-bg) !important;
  border: 2px solid var(--theme-btn-secondary-border) !important;
  color: var(--theme-btn-secondary-color) !important;
  transition: all 0.3s ease;
  font-weight: 600;
  padding: 0.6rem 1.5rem !important;
  border-radius: 0.5rem !important;
}

.btn-secondary:hover {
  background-color: #d3d7dd !important;
  border-color: #b8bcc2 !important;
  color: var(--theme-btn-secondary-color) !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
}

.btn-secondary:active {
  transform: translateY(0px) !important;
}

/* ===== ALERT ===== */
.alert-danger {
  background-color: #dc3545 !important;
  color: #ffffff !important;
  border: none !important;
  border-radius: 0.5rem !important;
  padding: 1rem 1.25rem !important;
}

.alert-danger ul {
  color: #ffffff !important;
  padding-left: 1.5rem !important;
  margin-bottom: 0 !important;
}

.alert-danger .btn-close {
  filter: brightness(0) invert(1);
}

.alert-success {
  border-radius: 0.5rem !important;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .card-body {
    padding: 1.25rem !important;
  }
  
  .d-flex.gap-2 {
    flex-direction: column;
  }
  
  .d-flex.gap-2 .btn {
    width: 100%;
    justify-content: center;
  }
  
  .theme-input,
  .theme-select,
  .theme-textarea {
    padding: 0.6rem 0.75rem !important;
    font-size: 0.9rem !important;
  }
  
  .form-label {
    font-size: 0.85rem !important;
  }
}

@media (max-width: 576px) {
  .container-fluid {
    padding-left: 0.75rem !important;
    padding-right: 0.75rem !important;
  }
  
  .card-body {
    padding: 1rem !important;
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
  background-color: var(--theme-input-focus);
  color: #ffffff;
}

/* ===== LINK ===== */
a {
  color: var(--theme-input-focus);
  text-decoration: none;
  transition: color 0.3s ease;
}

a:hover {
  color: var(--theme-input-focus);
  opacity: 0.8;
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