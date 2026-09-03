@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-header">
    <h2>Selamat Datang</h2>
    <p>Silakan masuk ke akun Anda</p>
</div>

{{-- Alert Notifikasi --}}
@if(session('error'))
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<form action="{{ route('login.process') }}" method="POST">
    @csrf

    {{-- Email --}}
    <div class="form-group">
        <label for="email">Email</label>
        <div class="input-wrapper">
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@gmail.com" required autofocus>
            <i class="fas fa-envelope input-icon"></i>
        </div>
        @error('email')
            <span class="input-error">{{ $message }}</span>
        @enderror
    </div>

    {{-- Password --}}
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrapper">
            <input type="password" id="password" name="password" placeholder="••••••••" required>
            <i class="fas fa-lock input-icon"></i>
            <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">
                <i class="fas fa-eye" id="eyeIcon"></i>
            </button>
        </div>
        @error('password')
            <span class="input-error">{{ $message }}</span>
        @enderror
    </div>

    {{-- Tombol Login --}}
    <button type="submit" class="btn-login" style="margin-top: 10px;">
        <span class="btn-shine"></span>
        <i class="fas fa-sign-in-alt"></i>
        <span>Masuk</span>
    </button>
</form>

{{-- Tombol Login Google --}}
<div style="margin-top: 15px;">
    <a href="{{ route('auth.google') }}" style="text-decoration: none;">
        <button type="button" class="btn-login" style="background: #ea4335; margin-top: 0;">
            <i class="fab fa-google"></i>
            <span>Masuk dengan Google</span>
        </button>
    </a>
</div>

{{-- Link ke Register --}}
<div class="register-link">
    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
</div>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>
@endpush