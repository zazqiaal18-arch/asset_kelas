@extends('layouts.auth')

@section('title', 'Daftar Akun')

@section('content')
<div class="login-header">
    <h2>Buat Akun Baru</h2>
    <p>Lengkapi data di bawah untuk mendaftar</p>
</div>

{{-- Alert Error --}}
@if ($errors->any())
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <ul style="margin-left: 15px; padding-left: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register.process') }}" method="POST">
    @csrf

    {{-- Nama Lengkap --}}
    <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <div class="input-wrapper">
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Anda" required>
            <i class="fas fa-user input-icon"></i>
        </div>
    </div>

    {{-- Email --}}
    <div class="form-group">
        <label for="email">Email</label>
        <div class="input-wrapper">
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@gmail.com" required>
            <i class="fas fa-envelope input-icon"></i>
        </div>
    </div>

    {{-- Password --}}
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrapper">
            <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
            <i class="fas fa-lock input-icon"></i>
        </div>
    </div>

    {{-- Konfirmasi Password --}}
    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <div class="input-wrapper">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
            <i class="fas fa-check-circle input-icon"></i>
        </div>
    </div>

    {{-- Tombol Register --}}
    <button type="submit" class="btn-login" style="margin-top: 10px;">
        <span class="btn-shine"></span>
        <i class="fas fa-user-plus"></i>
        <span>Daftar Sekarang</span>
    </button>
</form>

{{-- Tombol Google --}}
<div style="margin-top: 15px;">
    <a href="{{ route('auth.google') }}" style="text-decoration: none;">
        <button type="button" class="btn-login" style="background: #ea4335;">
            <i class="fab fa-google"></i>
            <span>Lanjutkan dengan Google</span>
        </button>
    </a>
</div>

{{-- Link ke Login --}}
<div class="register-link">
    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
</div>
@endsection