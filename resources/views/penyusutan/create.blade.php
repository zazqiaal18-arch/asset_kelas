@extends('template.app')

@section('title', 'Tambah Penyusutan Aset')

@section('content')
<div class="container-fluid px-0">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1">Tambah Penyusutan Aset</h3>
      <p class="text-muted mb-0">Isi formulir di bawah ini untuk mencatat masa ekonomis & penyusutan aset baru.</p>
    </div>
    <a href="{{ route('penyusutan.index') }}" class="btn btn-secondary btn-sm">
      <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
  </div>

  <!-- Form -->
  <div class="card border-0 shadow-sm">
    <div class="card-body p-4">
      <form action="{{ route('penyusutan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="barang_id" class="form-label fw-semibold">Pilih Barang Aset <span class="text-danger">*</span></label>
          <select name="barang_id" id="barang_id" class="form-select @error('barang_id') is-invalid @enderror" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barangs ?? [] as $barang)
              <option value="{{ $barang->id_barang }}" {{ old('barang_id') == $barang->id_barang ? 'selected' : '' }}>
                {{ $barang->nama_barang }} (Harga Beli: Rp {{ number_format($barang->harga_beli ?? 0, 0, ',', '.') }})
              </option>
            @endforeach
          </select>
          @error('barang_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="masa_ekonomis" class="form-label fw-semibold">Masa Ekonomis (Tahun) <span class="text-danger">*</span></label>
          <input type="number" name="masa_ekonomis" id="masa_ekonomis" class="form-control @error('masa_ekonomis') is-invalid @enderror" min="1" value="{{ old('masa_ekonomis') }}" placeholder="Contoh: 5" required>
          @error('masa_ekonomis')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="nilai_residu" class="form-label fw-semibold">Nilai Residu / Nilai Sisa (Rp)</label>
          <input type="number" name="nilai_residu" id="nilai_residu" class="form-control @error('nilai_residu') is-invalid @enderror" min="0" value="{{ old('nilai_residu', 0) }}" placeholder="Contoh: 100000">
          @error('nilai_residu')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="d-flex justify-content-end gap-2">
          <a href="{{ route('penyusutan.index') }}" class="btn btn-light">Batal</a>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Simpan Data
          </button>
        </div>

      </form>
    </div>
  </div>

</div>
@endsection
