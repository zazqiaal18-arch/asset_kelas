@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Kategori</h4>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('kategori.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Data kategori belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection