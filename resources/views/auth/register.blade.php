@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="login-header">
        <h2>Daftar Akun</h2>
        <p>Buat akun baru untuk memulai</p>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <div class="input-wrapper">
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    value="{{ old('name') }}" 
                    placeholder="Nama Lengkap"
                    required
                    autofocus
                >
                <i class="fas fa-user input-icon"></i>
                @error('name')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <div class="input-wrapper">
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    value="{{ old('email') }}" 
                    placeholder="nama@perusahaan.com"
                    required
                >
                <i class="fas fa-envelope input-icon"></i>
                @error('email')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    placeholder="Minimal 8 karakter"
                    required
                >
                <i class="fas fa-lock input-icon"></i>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="fas fa-eye" id="passwordIcon"></i>
                </button>
                @error('password')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-wrapper">
                <input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    placeholder="Konfirmasi password"
                    required
                >
                <i class="fas fa-check-circle input-icon"></i>
            </div>
        </div>

        <button type="submit" class="btn-login">
            <span class="btn-shine"></span>
            <i class="fas fa-user-plus"></i>
            Daftar
        </button>
    </form>

    <div class="register-link">
        Sudah punya akun?
        <a href="{{ route('login') }}">Masuk sekarang</a>
    </div>
@endsection

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }
</script>
@endpush