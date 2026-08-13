@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Kategori Baru</h1>
            <p class="text-sm text-gray-600">Isi formulir di bawah untuk menambahkan kategori baru ke sistem.</p>
        </div>
        <a href="{{ route('kategori.index') }}" 
           class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm transition font-medium">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 border border-gray-100">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <!-- Nama Kategori -->
            <div class="mb-5">
                <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="nama_kategori" 
                       id="nama_kategori" 
                       value="{{ old('nama_kategori') }}"
                       placeholder="Contoh: Elektronik, Pakaian, dll."
                       class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm @error('nama_kategori') border-red-500 @else border-gray-300 @enderror"
                       required>
                
                @error('nama_kategori')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug (Opsional jika di-generate otomatis di Controller) -->
            <div class="mb-5">
                <label for="slug" class="block text-sm font-semibold text-gray-700 mb-2">
                    Slug <span class="text-xs text-gray-400">(Opsional)</span>
                </label>
                <input type="text" 
                       name="slug" 
                       id="slug" 
                       value="{{ old('slug') }}"
                       placeholder="contoh-elektronik"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm @error('slug') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika ingin slug dibuat otomatis dari nama kategori.</p>
                
                @error('slug')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi Kategori -->
            <div class="mb-5">
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea name="deskripsi" 
                          id="deskripsi" 
                          rows="4" 
                          placeholder="Tambahkan keterangan ringkas mengenai kategori ini..."
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                
                @error('deskripsi')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Kategori -->
            <div class="mb-6">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1" 
                           class="sr-only peer" 
                           {{ old('is_active', 1) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 relative"></div>
                    <span class="ml-3 text-sm font-medium text-gray-700">Aktifkan Kategori</span>
                </label>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <a href="{{ route('kategori.index') }}" 
                   class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition focus:ring-4 focus:ring-blue-200">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection