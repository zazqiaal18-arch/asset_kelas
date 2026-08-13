<!DOCTYPE html>
<html lang="id">
<head>
  
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard')</title>

  <!-- CSS Bootstrap & Template -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <!-- KODE PERBAIKAN TATA LETAK NAVBAR & SIDEBAR -->
  <style>
    body {
      overflow-x: hidden;
      margin: 0;
      padding: 0;
    }

    .admin-shell {
      display: flex;
      width: 100vw;
      min-height: 100vh;
      overflow-x: hidden;
    }

    .admin-sidebar {
      width: 260px;
      flex-shrink: 0;
    }

    .admin-main {
      flex: 1;
      min-width: 0; /* Mencegah elemen kanan melebihi lebar layar */
      display: flex;
      flex-direction: column;
      width: calc(100% - 260px);
      overflow-x: hidden;
    }

    .admin-main > header,
    .admin-main > nav,
    .admin-main .navbar {
      width: 100%;
      box-sizing: border-box;
    }
  </style>
</head>
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <!-- Sidebar Kiri -->
    @include('template.sidebar')

    <!-- Area Kanan -->
    <div class="admin-main">
      <!-- Navbar Atas -->
      @include('template.navbar')

      <!-- Tempat Konten Berubah-ubah (Create / Dashboard / Tabel) -->
      <main class="dashboard-content p-4">
        @yield('content')
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
