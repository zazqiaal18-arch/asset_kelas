<aside class="admin-sidebar" id="adminSidebar">

    <div class="sidebar-header px-3 py-3">
        <a href="{{ url('/') }}"
           class="brand-mark text-decoration-none fw-bold fs-5">

            <span class="brand-icon">
                <i class="bi bi-boxes"></i>
            </span>

            <span class="brand-copy">
                Asset Kelas
            </span>

        </a>
    </div>


    <nav class="sidebar-nav">

        {{-- ========================================================= --}}
        {{-- DASHBOARD --}}
        {{-- ========================================================= --}}

        <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}"
           href="{{ route('dashboard') }}">

            <span class="nav-icon">
                <i class="bi bi-speedometer2"></i>
            </span>

            <span class="nav-text">
                Dashboard
            </span>

        </a>


        {{-- ========================================================= --}}
        {{-- DATA BARANG --}}
        {{-- USER & ADMIN BOLEH MELIHAT --}}
        {{-- ========================================================= --}}

        <a class="nav-link {{ request()->is('barang*') ? 'active' : '' }}"
           href="{{ route('barang.index') }}">

            <span class="nav-icon">
                <i class="bi bi-box-seam"></i>
            </span>

            <span class="nav-text">
                Data Barang
            </span>

        </a>


        {{-- ========================================================= --}}
        {{-- KATEGORI --}}
        {{-- ========================================================= --}}

        <a class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}"
           href="{{ route('kategori.index') }}">

            <span class="nav-icon">
                <i class="bi bi-tags"></i>
            </span>

            <span class="nav-text">
                Kategori Barang
            </span>

        </a>


        {{-- ========================================================= --}}
        {{-- STOK --}}
        {{-- ========================================================= --}}

        <a class="nav-link {{ request()->is('stok*') ? 'active' : '' }}"
           href="{{ route('stok.index') }}">

            <span class="nav-icon">
                <i class="bi bi-boxes"></i>
            </span>

            <span class="nav-text">
                Stok Barang
            </span>

        </a>


        {{-- ========================================================= --}}
        {{-- PENYUSUTAN --}}
        {{-- ========================================================= --}}

        <a class="nav-link {{ request()->is('penyusutan*') ? 'active' : '' }}"
           href="{{ route('penyusutan.index') }}">

            <span class="nav-icon">
                <i class="bi bi-calculator"></i>
            </span>

            <span class="nav-text">
                Penyusutan Aset
            </span>

        </a>


        {{-- ========================================================= --}}
        {{-- KERUSAKAN --}}
        {{-- USER & ADMIN --}}
        {{-- ========================================================= --}}

        <a class="nav-link {{ request()->is('kerusakan*') ? 'active' : '' }}"
           href="{{ route('kerusakan.index') }}">

            <span class="nav-icon">
                <i class="bi bi-tools"></i>
            </span>

            <span class="nav-text">
                Kerusakan Barang
            </span>

        </a>

    </nav>

</aside>