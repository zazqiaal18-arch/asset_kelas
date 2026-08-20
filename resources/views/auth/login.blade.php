@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-header">
        <h2>Selamat Datang</h2>
        <p>Masuk untuk melanjutkan ke dashboard</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form action="{{ route('login.authenticate') }}" method="POST">
        @csrf

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
                    autofocus
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
                    placeholder="Masukkan password"
                    required
                >
                <i class="fas fa-lock input-icon"></i>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="fas fa-eye" id="passwordIcon"></i>
                </button>
            </div>
        </div>

        <div class="form-options">
            <label class="remember-me">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span>Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-login">
            <span class="btn-shine"></span>
            <i class="fas fa-sign-in-alt"></i>
            Masuk
        </button>
    </form>

    <div class="register-link">
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar sekarang</a>
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