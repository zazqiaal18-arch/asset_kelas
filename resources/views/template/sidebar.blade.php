<aside class="admin-sidebar" id="adminSidebar">
  <div class="sidebar-header px-3 py-3">
    <a href="{{ url('/') }}" class="brand-mark text-decoration-none fw-bold fs-5">
      <span class="brand-icon"><i class="bi bi-boxes"></i></span>
      <span class="brand-copy">Asset Kelas</span>
    </a>
  </div>

  <nav class="sidebar-nav">
    <!-- Dashboard -->
    <a class="nav-link {{ request()->is('/') || request()->is('dashboard*') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
      <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
      <span class="nav-text">Dashboard</span>
    </a>

    <!-- Data Barang -->
    <a class="nav-link {{ request()->is('barang*') ? 'active' : '' }}" href="{{ route('barang.index') }}">
      <span class="nav-icon"><i class="bi bi-box-seam"></i></span>
      <span class="nav-text">Data Barang</span>
    </a>

    <!-- Kategori Barang -->
    <a class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
      <span class="nav-icon"><i class="bi bi-tags"></i></span>
      <span class="nav-text">Kategori Barang</span>
    </a>

    <!-- Stok Barang -->
    <a class="nav-link {{ request()->is('stok*') ? 'active' : '' }}" href="{{ route('stok.index') }}">
      <span class="nav-icon"><i class="bi bi-boxes"></i></span>
      <span class="nav-text">Stok Barang</span>
    </a>

    <!-- Penyusutan Aset -->
    <a class="nav-link {{ request()->is('penyusutan*') ? 'active' : '' }}" href="{{ route('penyusutan.index') }}">
      <span class="nav-icon"><i class="bi bi-calculator"></i></span>
      <span class="nav-text">Penyusutan Aset</span>
    </a>

    <!-- Kerusakan Barang -->
    <a class="nav-link {{ request()->is('kerusakan*') ? 'active' : '' }}" href="{{ route('kerusakan.index') }}">
      <span class="nav-icon"><i class="bi bi-tools"></i></span>
      <span class="nav-text">Kerusakan Barang</span>
    </a>

    <!-- Logout -->
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
      @csrf
      <button type="submit" class="nav-link border-0 bg-transparent text-danger w-100 text-start" onclick="return confirm('Yakin ingin keluar?')">
        <span class="nav-icon"><i class="bi bi-box-arrow-right text-danger"></i></span>
        <span class="nav-text fw-bold">Logout</span>
      </button>
    </form>
  </nav>

  <div class="sidebar-user">
    <img class="avatar-img avatar-md sidebar-user-avatar" src="{{ asset('assets/images/avatar/avatar.jpg') }}" alt="{{ ucfirst(optional(auth()->user())->role ?? 'User') }}">
    <strong data-user-role>{{ ucfirst(optional(auth()->user())->role ?? 'User') }}</strong>
    <small>Role Pengguna</small>
  </div>

  <div class="sidebar-footer">
    <span class="status-dot"></span>
    <span class="sidebar-footer-text">System running smoothly</span>
  </div>
</aside>
