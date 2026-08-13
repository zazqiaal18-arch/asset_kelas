@extends('template.app')

@section('title', 'Edit Data Barang')

@section('content')
<div class="container-fluid px-0">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1 theme-text-primary">Edit Barang</h3>
      <p class="mb-0 theme-text-secondary">Edit data barang: <strong class="theme-text-primary">{{ $barang->nama_barang }}</strong></p>
    </div>
    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
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
      <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Barang -->
        <div class="mb-4">
          <label for="nama_barang" class="form-label fw-semibold theme-text-primary">
            <i class="bi bi-box me-1"></i> Nama Barang
          </label>
          <input type="text" 
                 class="form-control theme-input @error('nama_barang') is-invalid @enderror" 
                 id="nama_barang" 
                 name="nama_barang" 
                 value="{{ old('nama_barang', $barang->nama_barang) }}" 
                 placeholder="Masukkan nama barang" 
                 required>
          @error('nama_barang')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Jumlah / Stok -->
        <div class="mb-4">
          <label for="jumlah" class="form-label fw-semibold theme-text-primary">
            <i class="bi bi-hash me-1"></i> Jumlah / Stok
          </label>
          <input type="number" 
                 class="form-control theme-input @error('jumlah') is-invalid @enderror" 
                 id="jumlah" 
                 name="jumlah" 
                 min="1" 
                 value="{{ old('jumlah', $barang->jumlah) }}" 
                 placeholder="Masukkan jumlah stok" 
                 required>
          @error('jumlah')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Tanggal Beli -->
        <div class="mb-4">
          <label for="tanggal_beli" class="form-label fw-semibold theme-text-primary">
            <i class="bi bi-calendar me-1"></i> Tanggal Beli
          </label>
          <input type="date" 
                 class="form-control theme-input @error('tanggal_beli') is-invalid @enderror" 
                 id="tanggal_beli" 
                 name="tanggal_beli" 
                 value="{{ old('tanggal_beli', $barang->tanggal_beli) }}">
          @error('tanggal_beli')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Harga Beli -->
        <div class="mb-4">
          <label for="harga_beli" class="form-label fw-semibold theme-text-primary">
            <i class="bi bi-coin me-1"></i> Harga Beli (Rp)
          </label>
          <input type="number" 
                 class="form-control theme-input @error('harga_beli') is-invalid @enderror" 
                 id="harga_beli" 
                 name="harga_beli" 
                 min="0" 
                 step="1000"
                 value="{{ old('harga_beli', $barang->harga_beli) }}" 
                 placeholder="Masukkan harga beli">
          @error('harga_beli')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          <small class="theme-text-secondary d-block mt-1">
            <i class="bi bi-info-circle me-1"></i>
            Format: angka tanpa titik atau koma (contoh: 1500000)
          </small>
        </div>

        <!-- Tombol Submit -->
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-lg me-1"></i> Update Barang
          </button>
          <a href="{{ route('barang.index') }}" class="btn btn-secondary px-4">
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
      ID Barang: <strong class="theme-text-primary">{{ $barang->id_barang }}</strong>
      &nbsp;|&nbsp; 
      Dibuat: <strong class="theme-text-primary">{{ $barang->created_at ? $barang->created_at->format('d-m-Y H:i') : '-' }}</strong>
      &nbsp;|&nbsp;
      Terakhir diupdate: <strong class="theme-text-primary">{{ $barang->updated_at ? $barang->updated_at->format('d-m-Y H:i') : '-' }}</strong>
    </small>
  </div>

</div>
@endsection

@push('styles')
<style>
/* ===== DARK/LIGHT MODE VARIABLES ===== */
:root {
  /* Light Mode */
  --theme-bg-body: #f8f9fa;
  --theme-bg-card: #ffffff;
  --theme-text-primary: #212529;
  --theme-text-secondary: #6c757d;
  --theme-border-color: #e0e0e0;
  --theme-input-bg: #ffffff;
  --theme-input-border: #ced4da;
  --theme-input-focus: #0d6efd;
  --theme-input-shadow: rgba(13, 110, 253, 0.25);
  --theme-label-color: #212529;
  --theme-card-shadow: rgba(0, 0, 0, 0.05);
  --theme-placeholder: #6c757d;
}

[data-bs-theme="dark"] {
  /* Dark Mode */
  --theme-bg-body: #0d0d1a;
  --theme-bg-card: #1a1a2e;
  --theme-text-primary: #e8e8f0;
  --theme-text-secondary: #a0a0b8;
  --theme-border-color: #2a2a3e;
  --theme-input-bg: #ffffff;
  --theme-input-border: #ced4da;
  --theme-input-focus: #4d8cf7;
  --theme-input-shadow: rgba(77, 140, 247, 0.3);
  --theme-label-color: #e8e8f0;
  --theme-card-shadow: rgba(0, 0, 0, 0.4);
  --theme-placeholder: #6c757d;
}

/* ===== BODY ===== */
body {
  background-color: var(--theme-bg-body) !important;
  color: var(--theme-text-primary);
  transition: background-color 0.3s ease, color 0.3s ease;
}

/* ===== CARD (DISINKRONKAN DENGAN TEMA) ===== */
.theme-card {
  background-color: var(--theme-bg-card) !important;
  border: 1px solid var(--theme-border-color) !important;
  transition: background-color 0.3s ease, border-color 0.3s ease;
  box-shadow: 0 4px 15px var(--theme-card-shadow) !important;
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

/* ===== INPUT ===== */
.theme-input {
  background-color: #ffffff !important;
  color: #1a1a2e !important;
  border: 1.5px solid var(--theme-input-border) !important;
  transition: all 0.3s ease;
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
}

/* Tombol Batal & Kembali disamakan menjadi btn-secondary agar selalu kontras */
.btn-secondary {
  background-color: #6c757d !important;
  border-color: #6c757d !important;
  color: #ffffff !important;
  transition: all 0.3s ease;
  font-weight: 600;
  padding: 0.6rem 1.5rem !important;
  border-radius: 0.5rem !important;
}

.btn-secondary:hover {
  background-color: #5c636a !important;
  border-color: #565e64 !important;
  color: #ffffff !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3) !important;
}

/* ===== RESPONSIVE & SMOOTH TRANSITION ===== */
* {
  transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-bs-theme', savedTheme);
});
</script>
@endpush