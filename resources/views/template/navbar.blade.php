<nav class="admin-navbar navbar navbar-expand-lg bg-white border-bottom shadow-sm">
  <div class="container-fluid px-3 px-lg-4 py-2">
    <div class="d-flex align-items-center gap-3">
      <button class="btn btn-light border d-lg-none" type="button" data-sidebar-toggle aria-label="Buka menu">
        <i class="bi bi-list"></i>
      </button>

      <div>
        <div class="text-uppercase small fw-bold text-primary mb-0">Inventaris</div>
        <div class="fw-semibold text-dark mb-0">Aset Kelas</div>
      </div>
    </div>

    <div class="ms-auto d-flex align-items-center gap-2">
      <div class="dropdown">
        <button class="btn btn-light border shadow-sm dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="d-none d-sm-inline fw-semibold text-dark">{{ optional(auth()->user())->name ?? 'User' }}</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
          <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin keluar?')">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
