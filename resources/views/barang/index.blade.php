@extends('template.app')

@section('title', 'Data Barang Kelas')

@section('content')
<div class="container-fluid px-0">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1 theme-text-primary">Data Barang Kelas</h3>
      <p class="mb-0 theme-text-secondary">Daftar seluruh barang / aset kelas yang terdata.</p>
    </div>
    <a href="{{ route('barang.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> Tambah Barang Baru
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
              <th scope="col" class="theme-text-secondary">JUMLAH</th>
              <th scope="col" class="theme-text-secondary">TANGGAL BELI</th>
              <th scope="col" class="theme-text-secondary">HARGA BELI</th>
              <th scope="col" class="text-end pe-4 theme-text-secondary">AKSI</th>
            </tr>
          </thead>
          <tbody>
            @forelse($barangs as $item)
              <tr class="border-bottom theme-border">
                <td class="ps-4 fw-semibold theme-text-secondary">{{ $loop->iteration }}</td>
                <td class="fw-bold theme-text-primary">{{ $item->nama_barang }}</td>
                <td>
                  <span class="fw-bold theme-text-primary">{{ $item->jumlah }}</span>
                </td>
                <td class="theme-text-secondary">
                  {{ $item->tanggal_beli ? \Carbon\Carbon::parse($item->tanggal_beli)->format('d-m-Y') : '-' }}
                </td>
                <td class="theme-text-primary">
                  {{ $item->harga_beli ? 'Rp ' . number_format($item->harga_beli, 0, ',', '.') : '-' }}
                </td>
                <td class="text-end pe-4">
                  <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-warning btn-sm me-1 fw-bold">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  
                  <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus barang ini?')">
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
                  Belum ada data barang.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection