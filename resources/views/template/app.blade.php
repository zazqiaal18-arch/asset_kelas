<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'Dashboard Inventaris')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <style>
    body {
      margin: 0;
      overflow-x: hidden;
      background: #f4f7fb;
      color: #1f2937;
    }

    .admin-shell {
      display: flex;
      min-height: 100vh;
      width: 100%;
    }

    .admin-main {
      flex: 1;
      min-width: 0;
      display: flex;
      flex-direction: column;
    }

    .dashboard-content {
      flex: 1;
      padding: 1.5rem 1.5rem 2rem;
    }

    .dashboard-content > .container-fluid {
      padding: 0;
    }

    @media (max-width: 991.98px) {
      .admin-shell {
        display: block;
      }
    }
  </style>
</head>
<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    @include('template.sidebar')

    <div class="admin-main">
      @include('template.navbar')

      <main class="dashboard-content">
        @yield('content')
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
