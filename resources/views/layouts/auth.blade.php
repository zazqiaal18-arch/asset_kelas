<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Login') - {{ config('app.name') }}</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f4f7fb;
            overflow: hidden;
        }

        /* Left Section - Branding */
        .left-section {
            flex: 1;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 52%, #bfdbfe 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left-section::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(52, 152, 219, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 10s ease-in-out infinite;
        }

        .left-section::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(231, 76, 60, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 15s ease-in-out infinite reverse;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.5; }
            50% { transform: scale(1.3) rotate(180deg); opacity: 1; }
        }

        .brand-content {
            position: relative;
            z-index: 1;
            max-width: 480px;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 50px;
        }

        .brand-logo .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }

        .brand-logo .logo-icon i {
            font-size: 28px;
            color: white;
        }

        .brand-logo span {
            color: white;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .brand-content h1 {
            color: white;
            font-size: 38px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .brand-content h1 .highlight {
            color: #3498db;
            display: block;
            margin-top: 4px;
        }

        .brand-content .subtitle {
            color: rgba(255,255,255,0.6);
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 40px;
        }

        .brand-features {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 16px;
            color: rgba(255,255,255,0.85);
            font-size: 15px;
        }

        .feature-item .icon-box {
            width: 38px;
            height: 38px;
            background: rgba(52, 152, 219, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(52, 152, 219, 0.1);
        }

        .feature-item .icon-box i {
            font-size: 16px;
            color: #3498db;
        }

        .grid-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(52, 152, 219, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(52, 152, 219, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 0;
        }

        /* Right Section - Login Form */
        .right-section {
            flex: 1;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
        }

        .right-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(52, 152, 219, 0.03) 0%, transparent 70%);
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
        }

        .login-header {
            margin-bottom: 35px;
        }

        .login-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #ecf0f1;
            margin-bottom: 6px;
        }

        .login-header p {
            color: rgba(236, 240, 241, 0.5);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: rgba(236, 240, 241, 0.7);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(236, 240, 241, 0.2);
            font-size: 15px;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            padding: 13px 16px 13px 46px;
            background: rgba(255,255,255,0.05);
            border: 2px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            font-size: 14px;
            color: #ecf0f1;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-wrapper input::placeholder {
            color: rgba(236, 240, 241, 0.2);
        }

        .input-wrapper input:focus {
            border-color: #3498db;
            background: rgba(255,255,255,0.08);
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.08);
        }

        .input-wrapper input:focus ~ .input-icon {
            color: #3498db;
        }

        .input-wrapper .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(236, 240, 241, 0.2);
            cursor: pointer;
            font-size: 15px;
            padding: 5px;
            transition: color 0.3s ease;
        }

        .input-wrapper .toggle-password:hover {
            color: rgba(236, 240, 241, 0.5);
        }

        .input-error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 6px 0 28px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(236, 240, 241, 0.5);
            font-size: 14px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 17px;
            height: 17px;
            accent-color: #3498db;
            cursor: pointer;
            border-radius: 4px;
            background: rgba(255,255,255,0.05);
            border: 2px solid rgba(255,255,255,0.1);
        }

        .forgot-link {
            color: rgba(236, 240, 241, 0.4);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #3498db;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(52, 152, 219, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login .btn-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.6s ease;
        }

        .btn-login:hover .btn-shine {
            left: 100%;
        }

        .btn-login i {
            font-size: 16px;
        }

        .register-link {
            text-align: center;
            margin-top: 26px;
            color: rgba(236, 240, 241, 0.4);
            font-size: 14px;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #5dade2;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            border: 1px solid rgba(46, 204, 113, 0.15);
            color: #58d68d;
        }

        .alert-error {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.15);
            color: #ec7063;
        }

        .alert i {
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .left-section {
                padding: 40px 30px;
            }

            .brand-content h1 {
                font-size: 30px;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
                overflow-y: auto;
            }

            .left-section {
                padding: 40px 30px;
                min-height: 35vh;
            }

            .brand-content h1 {
                font-size: 26px;
            }

            .brand-features {
                display: none;
            }

            .right-section {
                padding: 30px 20px;
                min-height: 65vh;
            }

            .login-wrapper {
                max-width: 100%;
            }

            .login-header h2 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .left-section {
                padding: 30px 20px;
                min-height: 30vh;
            }

            .brand-logo span {
                font-size: 20px;
            }

            .brand-content h1 {
                font-size: 22px;
            }

            .form-options {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
        }

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .left-section {
            animation: fadeInLeft 0.8s ease;
        }

        .right-section {
            animation: fadeInRight 0.8s ease;
        }

        .brand-logo span,
        .brand-content h1,
        .login-header h2 {
            color: #0f172a;
        }

        .brand-content .subtitle,
        .feature-item,
        .login-header p,
        .form-group label,
        .remember-me,
        .forgot-link,
        .register-link {
            color: #475569;
        }

        .brand-content h1 .highlight,
        .register-link a,
        .forgot-link:hover {
            color: #2563eb;
        }

        .feature-item .icon-box {
            background: rgba(37, 99, 235, 0.1);
            border-color: rgba(37, 99, 235, 0.18);
        }

        .feature-item .icon-box i,
        .input-wrapper .input-icon {
            color: #2563eb;
        }

        .input-wrapper input {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        .input-wrapper input::placeholder {
            color: #94a3b8;
        }

        .input-wrapper input:focus {
            background: #ffffff;
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .input-wrapper .toggle-password {
            color: #94a3b8;
        }

        .input-wrapper .toggle-password:hover {
            color: #2563eb;
        }

        .grid-pattern {
            opacity: 0.45;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Left Section -->
    <div class="left-section">
        <div class="grid-pattern"></div>
        
        <div class="brand-content">
            <div class="brand-logo">
                <div class="logo-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <span>{{ config('app.name') }}</span>
            </div>

            <h1>
                {{ $brandTitle ?? 'Inventory Digital' }}
                <span class="highlight">{{ $brandHighlight ?? 'Untuk Inventaris Barang Anda' }}</span>
            </h1>

            <p class="subtitle">
                {{ $brandDescription ?? 'Platform terintegrasi yang membantu Anda mengelola barang dengan lebih efisien dan profesional.' }}
            </p>

            <div class="brand-features">
                @foreach($features ?? [
                    ['icon' => 'fa-chart-line', 'text' => 'Analitik & Laporan Real-time'],
                    ['icon' => 'fa-users', 'text' => 'Manajemen Tim & Kolaborasi'],
                    ['icon' => 'fa-shield-alt', 'text' => 'Keamanan Data Terenkripsi']
                ] as $feature)
                    <div class="feature-item">
                        <div class="icon-box">
                            <i class="fas {{ $feature['icon'] }}"></i>
                        </div>
                        <span>{{ $feature['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="right-section">
        <div class="login-wrapper">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>