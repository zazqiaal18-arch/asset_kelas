@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Kategori</h1>
            <p class="text-sm text-gray-600">Kelola daftar kategori barang di dalam sistem.</p>
        </div>
        <a href="{{ route('kategori.create') }}" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition font-medium shadow-sm flex items-center gap-2">
            <span>+</span> Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase font-semibold text-gray-600">
                        <th class="py-3 px-4 w-16">No</th>
                        <th class="py-3 px-4">Nama Kategori</th>
                        <th class="py-3 px-4">Slug</th>
                        <th class="py-3 px-4">Deskripsi</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($kategori as $key => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 font-medium text-gray-500">{{ $key + 1 }}</td>
                            <td class="py-3 px-4 font-semibold text-gray-800">{{ $item->nama_kategori }}</td>
                            <td class="py-3 px-4 text-gray-500 font-mono text-xs">{{ $item->slug ?? '-' }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $item->deskripsi ?? '-' }}</td>
                            <td class="py-3 px-4 text-center">
                                @if($item->is_active ?? true)
                                    <span class="px-2.5 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Aktif</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('kategori.edit', $item->id_kategori) }}" 
                                       class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-xs font-medium transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('kategori.destroy', $item->id_kategori) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-medium transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400">
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