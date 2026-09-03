```blade
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Kategori</title>
</head>
<body>

    <a href="{{ route('kategori.index') }}">← Kembali ke Daftar Kategori</a>

    <h1>Edit Kategori: {{ $kategori->nama_kategori }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  <!-- Form Card -->
  <div class="card border-0 theme-card shadow-sm">
    <div class="card-body p-4">
      <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Kategori -->
        <div class="mb-4">
          <label for="nama_kategori" class="form-label fw-semibold theme-text-primary">
            <i class="bi bi-tag me-1"></i> Nama Kategori
          </label>
          <input type="text" 
                 class="form-control theme-input @error('nama_kategori') is-invalid @enderror" 
                 id="nama_kategori" 
                 name="nama_kategori" 
                 value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                 placeholder="Masukkan nama kategori" 
                 required>
          @error('nama_kategori')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-lg me-1"></i> Update Kategori
          </button>
          <a href="{{ route('kategori.index') }}" class="btn btn-secondary px-4">
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
      ID Kategori: <strong class="theme-text-primary">{{ $kategori->id_kategori }}</strong>
      &nbsp;|&nbsp; 
      Dibuat: <strong class="theme-text-primary">{{ $kategori->created_at ? $kategori->created_at->format('d-m-Y H:i') : '-' }}</strong>
      &nbsp;|&nbsp;
      Terakhir diupdate: <strong class="theme-text-primary">{{ $kategori->updated_at ? $kategori->updated_at->format('d-m-Y H:i') : '-' }}</strong>
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

.theme-input:disabled,
.theme-input[readonly] {
  background-color: #f0f0f0 !important;
  opacity: 0.7;
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
  
  .theme-input {
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