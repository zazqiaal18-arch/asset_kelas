<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
    <script src="[https://cdn.tailwindcss.com](https://cdn.tailwindcss.com)"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Kategori</h1>
            <a href="{{ route('kategori.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Kategori Baru
            </a>
        </div>

        <table class="w-full text-left border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nama Kategori</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $index => $item)
                    <tr>
                        <td class="border p-2">{{ $index + 1 }}</td>
                        <td class="border p-2">{{ $item->nama_kategori }}</td>
                        <td class="border p-2">
                            <a href="{{ route('kategori.edit', $item->id_kategori) }}" class="text-blue-600 mr-2">Edit</a>
                            <form action="{{ route('kategori.destroy', $item->id_kategori) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border p-2 text-center text-gray-500">Belum ada data kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>