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
