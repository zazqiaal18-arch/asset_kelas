@extends('template.app')

@section('title', 'Data Kerusakan Barang')

@section('content')

<div class="container-fluid px-0">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1 theme-text-primary">
                Laporan Kerusakan Barang
            </h3>

            <p class="mb-0 theme-text-secondary">
                @if(auth()->user()->role === 'admin')
                    Kelola seluruh laporan kerusakan barang.
                @else
                    Pantau laporan kerusakan yang kamu kirim.
                @endif
            </p>
        </div>

        <a href="{{ route('kerusakan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Laporkan Kerusakan
        </a>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">

            <strong>Berhasil!</strong>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">

            <strong>Gagal!</strong>
            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">

            <strong>Terjadi kesalahan!</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- TABLE CARD --}}
    <div class="card border-0 theme-card shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table theme-table table-hover align-middle mb-0">

                    {{-- TABLE HEADER --}}
                    <thead>

                        <tr class="border-bottom theme-border">

                            <th class="ps-4 theme-text-secondary">
                                NO
                            </th>

                            {{-- PELAPOR KHUSUS ADMIN --}}
                            @if(auth()->user()->role === 'admin')

                                <th class="theme-text-secondary">
                                    PELAPOR
                                </th>

                            @endif

                            <th class="theme-text-secondary">
                                NAMA BARANG
                            </th>

                            <th class="theme-text-secondary text-center">
                                JUMLAH
                            </th>

                            <th class="theme-text-secondary text-center">
                                TINGKAT
                            </th>

                            <th class="theme-text-secondary">
                                DESKRIPSI
                            </th>

                            <th class="theme-text-secondary text-center">
                                STATUS
                            </th>

                            {{-- AKSI KHUSUS ADMIN --}}
                            @if(auth()->user()->role === 'admin')

                                <th class="text-end pe-4 theme-text-secondary">
                                    AKSI
                                </th>

                            @endif

                        </tr>

                    </thead>


                    {{-- TABLE BODY --}}
                    <tbody>

                        @forelse($kerusakans as $item)

                            <tr class="border-bottom theme-border">

                                {{-- NO --}}
                                <td class="ps-4 fw-semibold theme-text-secondary">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- PELAPOR --}}
                                @if(auth()->user()->role === 'admin')

                                    <td class="theme-text-primary">

                                        <div class="fw-bold">
                                            {{ $item->user->name ?? 'User Lama' }}
                                        </div>

                                        @if($item->user)

                                            <small class="text-muted">
                                                {{ $item->user->email }}
                                            </small>

                                        @endif

                                    </td>

                                @endif


                                {{-- NAMA BARANG --}}
                                <td class="fw-bold theme-text-primary">

                                    {{ $item->barang->nama_barang ?? 'Barang Dihapus' }}

                                </td>


                                {{-- JUMLAH RUSAK --}}
                                <td class="text-center">

                                    <span class="badge theme-badge-jumlah">
                                        {{ $item->jumlah_rusak }}
                                    </span>

                                </td>


                                {{-- TINGKAT KERUSAKAN --}}
                                <td class="text-center">

                                    @php

                                        switch ($item->tingkat_kerusakan) {

                                            case 'Ringan':
                                                $badgeClass = 'badge-tingkat-ringan';
                                                $icon = '🟢';
                                                break;

                                            case 'Sedang':
                                                $badgeClass = 'badge-tingkat-sedang';
                                                $icon = '🟡';
                                                break;

                                            case 'Berat':
                                                $badgeClass = 'badge-tingkat-berat';
                                                $icon = '🔴';
                                                break;

                                            default:
                                                $badgeClass = 'bg-secondary';
                                                $icon = '⚪';
                                                break;

                                        }

                                    @endphp

                                    <span class="badge {{ $badgeClass }}">

                                        {{ $icon }}
                                        {{ $item->tingkat_kerusakan ?? '-' }}

                                    </span>

                                </td>


                                {{-- DESKRIPSI --}}
                                <td class="theme-text-secondary">

                                    {{ Str::limit($item->deskripsi_kerusakan ?? '-', 50) }}

                                </td>


                                {{-- STATUS --}}
                                <td class="text-center">

                                    @php
                                        $status = $item->status_penanganan ?? 'Menunggu';
                                    @endphp


                                    @if($status === 'Menunggu')

                                        <span class="badge bg-warning text-dark">

                                            <i class="bi bi-clock me-1"></i>
                                            Menunggu

                                        </span>


                                    @elseif($status === 'Dikerjakan')

                                        <span class="badge bg-primary">

                                            <i class="bi bi-tools me-1"></i>
                                            Dikerjakan

                                        </span>


                                    @elseif($status === 'Selesai')

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>
                                            Selesai

                                        </span>


                                    @elseif($status === 'Ditolak')

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-circle me-1"></i>
                                            Ditolak

                                        </span>


                                    @else

                                        <span class="badge bg-secondary">
                                            {{ $status }}
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI ADMIN --}}
                                @if(auth()->user()->role === 'admin')

                                    <td class="text-end pe-4">

                                        {{-- STATUS MENUNGGU --}}
                                        @if($status === 'Menunggu')

                                            {{-- TERIMA --}}
                                            <form
                                                action="{{ route('kerusakan.terima', $item->id_kerusakan) }}"
                                                method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('PUT')

                                                <button
                                                    type="submit"
                                                    class="btn btn-success btn-sm"
                                                    onclick="return confirm('Terima laporan ini?')">

                                                    <i class="bi bi-check-lg me-1"></i>
                                                    Terima

                                                </button>

                                            </form>


                                            {{-- TOLAK --}}
                                            <button
                                                type="button"
                                                class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#tolakModal{{ $item->id_kerusakan }}">

                                                <i class="bi bi-x-lg me-1"></i>
                                                Tolak

                                            </button>


                                        {{-- STATUS DIKERJAKAN --}}
                                        @elseif($status === 'Dikerjakan')

                                            <form
                                                action="{{ route('kerusakan.selesai', $item->id_kerusakan) }}"
                                                method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('PUT')

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-sm"
                                                    onclick="return confirm('Tandai laporan ini sebagai selesai?')">

                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Selesai

                                                </button>

                                            </form>


                                        {{-- STATUS SELESAI --}}
                                        @elseif($status === 'Selesai')

                                            <span class="badge bg-success me-1">

                                                <i class="bi bi-check-circle me-1"></i>
                                                Selesai

                                            </span>


                                        {{-- STATUS DITOLAK --}}
                                        @elseif($status === 'Ditolak')

                                            <span class="badge bg-danger me-1">

                                                <i class="bi bi-x-circle me-1"></i>
                                                Ditolak

                                            </span>

                                        @endif


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('kerusakan.edit', $item->id_kerusakan) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Edit">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('kerusakan.destroy', $item->id_kerusakan) }}"
                                            method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Hapus"
                                                onclick="return confirm('Yakin mau menghapus laporan ini?')">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                @endif

                            </tr>

                        @empty

                            {{-- DATA KOSONG --}}
                            <tr>

                                <td
                                    colspan="{{ auth()->user()->role === 'admin' ? 8 : 6 }}"
                                    class="text-center py-5 theme-text-secondary">

                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                                    @if(auth()->user()->role === 'admin')

                                        Belum ada laporan kerusakan.

                                    @else

                                        Kamu belum memiliki laporan kerusakan.

                                    @endif

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- MODAL TOLAK --}}
    @if(auth()->user()->role === 'admin')

        @foreach($kerusakans as $item)

            @php
                $statusModal = $item->status_penanganan ?? 'Menunggu';
            @endphp

            @if($statusModal === 'Menunggu')

                <div
                    class="modal fade"
                    id="tolakModal{{ $item->id_kerusakan }}"
                    tabindex="-1"
                    aria-labelledby="tolakModalLabel{{ $item->id_kerusakan }}"
                    aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <form
                                action="{{ route('kerusakan.tolak', $item->id_kerusakan) }}"
                                method="POST">

                                @csrf
                                @method('PUT')


                                {{-- MODAL HEADER --}}
                                <div class="modal-header">

                                    <h5
                                        class="modal-title"
                                        id="tolakModalLabel{{ $item->id_kerusakan }}">

                                        <i class="bi bi-x-circle text-danger me-2"></i>
                                        Tolak Laporan

                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>

                                </div>


                                {{-- MODAL BODY --}}
                                <div class="modal-body">

                                    <p class="mb-3">

                                        Apakah kamu yakin ingin menolak
                                        laporan kerusakan

                                        <strong>
                                            {{ $item->barang->nama_barang ?? 'Barang' }}
                                        </strong>
                                        ?

                                    </p>


                                    <label
                                        for="keterangan{{ $item->id_kerusakan }}"
                                        class="form-label">

                                        Alasan Penolakan

                                    </label>

                                    <textarea
                                        id="keterangan{{ $item->id_kerusakan }}"
                                        name="keterangan"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Masukkan alasan penolakan..."></textarea>

                                </div>


                                {{-- MODAL FOOTER --}}
                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <button
                                        type="submit"
                                        class="btn btn-danger">

                                        <i class="bi bi-x-lg me-1"></i>
                                        Tolak Laporan

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            @endif

        @endforeach

    @endif


    {{-- TOTAL LAPORAN --}}
    @if($kerusakans->count() > 0)

        <div class="mt-3 theme-text-secondary">

            <small>

                Total Laporan:

                <strong class="theme-text-primary">
                    {{ $kerusakans->count() }}
                </strong>

                laporan

            </small>

        </div>

    @endif

</div>

@endsection