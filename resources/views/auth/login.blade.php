<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Masuk ke Akun</h1>
            <p class="text-sm text-gray-500 mt-1">Silakan masukkan email dan password Anda</p>
        </div>

        <!-- Alert Notifikasi Gagal/Logout -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 text-sm rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm @error('email') border-red-500 @else border-gray-300 @enderror">
                
                @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition duration-200">
                Masuk
            </button>
        </form>
    </div>

</body>
</html>