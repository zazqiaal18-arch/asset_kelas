<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asset Kelas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            body {
                font-family: 'Segoe UI', Arial, sans-serif;
                background: linear-gradient(135deg, #f3f8ff 0%, #eef4ff 30%, #f7fafc 100%);
                color: #0f172a;
            }
            .landing-wrap {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 48px 20px;
            }
            .landing-card {
                width: min(1100px, 100%);
                background: rgba(255,255,255,0.95);
                border: 1px solid rgba(148, 163, 184, 0.2);
                border-radius: 28px;
                box-shadow: 0 30px 80px rgba(37, 99, 235, 0.10);
                overflow: hidden;
            }
            .landing-hero {
                display: grid;
                grid-template-columns: 1.2fr 0.8fr;
            }
            .hero-left {
                padding: 54px 48px;
                background: linear-gradient(135deg, #eff6ff 0%, #f8fbff 100%);
            }
            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 14px;
                border-radius: 999px;
                background: #dbeafe;
                color: #1d4ed8;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }
            .hero-title {
                font-size: clamp(2.2rem, 4vw, 4rem);
                font-weight: 800;
                line-height: 1.1;
                margin-top: 22px;
                margin-bottom: 16px;
            }
            .hero-title span { color: #2563eb; }
            .hero-subtitle {
                color: #475569;
                font-size: 1.08rem;
                line-height: 1.8;
                max-width: 560px;
            }
            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 14px;
                margin-top: 30px;
            }
            .btn-primary-custom {
                background: linear-gradient(135deg, #2563eb, #1d4ed8);
                border: none;
                color: white;
                padding: 14px 24px;
                border-radius: 12px;
                font-weight: 700;
                box-shadow: 0 12px 24px rgba(37, 99, 235, 0.22);
            }
            .btn-secondary-custom {
                background: white;
                color: #0f172a;
                border: 1px solid #dbe2ea;
                padding: 14px 24px;
                border-radius: 12px;
                font-weight: 700;
            }
            .hero-right {
                background: linear-gradient(180deg, #1d4ed8 0%, #2563eb 100%);
                padding: 42px 28px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .stat-panel {
                width: 100%;
                background: rgba(255,255,255,0.12);
                border: 1px solid rgba(255,255,255,0.24);
                border-radius: 24px;
                padding: 24px;
                color: white;
                backdrop-filter: blur(8px);
            }
            .mini-stat {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 16px;
                background: rgba(255,255,255,0.08);
                border-radius: 14px;
                margin-bottom: 16px;
            }
            .mini-stat:last-child { margin-bottom: 0; }
            .mini-icon {
                width: 44px;
                height: 44px;
                background: rgba(255,255,255,0.15);
                border-radius: 12px;
                display: grid;
                place-items: center;
                font-size: 1.1rem;
            }
            .feature-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 18px;
                padding: 26px 32px 32px;
                background: #ffffff;
            }
            .feature-box {
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 18px;
                padding: 24px 18px;
                text-align: center;
            }
            .feature-box i {
                font-size: 1.6rem;
                color: #2563eb;
                margin-bottom: 12px;
                display: inline-block;
            }
            .feature-box h4 {
                font-size: 1.02rem;
                font-weight: 700;
                margin-bottom: 8px;
            }
            .feature-box p {
                margin: 0;
                color: #64748b;
                font-size: 0.92rem;
                line-height: 1.6;
            }
            @media (max-width: 768px) {
                .landing-hero { grid-template-columns: 1fr; }
                .hero-left { padding: 36px 24px; }
                .hero-right { padding: 24px; }
                .feature-grid { grid-template-columns: 1fr; }
            }
        </style>
    </head>
    <body>
        <div class="landing-wrap">
            <div class="landing-card">
                <div class="landing-hero">
                    <div class="hero-left">
                        <div class="hero-badge"><i class="fa-solid fa-boxes-stacked"></i> Asset Kelas</div>
                        <h1 class="hero-title">Kelola inventaris sekolah <span>lebih cepat</span> dan lebih rapi.</h1>
                        <p class="hero-subtitle">
                            Sistem inventaris barang untuk memantau stok, penyusutan aset, kerusakan, dan data barang secara terorganisir dalam satu dashboard yang bersih dan mudah digunakan.
                        </p>
                        <div class="hero-actions">
                            <a href="{{ route('login') }}" class="btn btn-primary-custom">Masuk ke Dashboard</a>
                            <a href="{{ route('register') }}" class="btn btn-secondary-custom">Buat Akun</a>
                        </div>
                    </div>
                    <div class="hero-right">
                        <div class="stat-panel">
                            <div class="mini-stat">
                                <div>
                                    <div class="small text-white-50 mb-1">Barang Terdaftar</div>
                                    <h3 class="mb-0 fw-bold">1.250+</h3>
                                </div>
                                <div class="mini-icon"><i class="fa-solid fa-box"></i></div>
                            </div>
                            <div class="mini-stat">
                                <div>
                                    <div class="small text-white-50 mb-1">Transaksi Hari Ini</div>
                                    <h3 class="mb-0 fw-bold">86</h3>
                                </div>
                                <div class="mini-icon"><i class="fa-solid fa-chart-line"></i></div>
                            </div>
                            <div class="mini-stat">
                                <div>
                                    <div class="small text-white-50 mb-1">Barang Rusak</div>
                                    <h3 class="mb-0 fw-bold">12</h3>
                                </div>
                                <div class="mini-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="feature-grid">
                    <div class="feature-box">
                        <i class="fa-solid fa-warehouse"></i>
                        <h4>Data Barang</h4>
                        <p>Catat semua item aset dengan struktur data yang rapi dan terukur.</p>
                    </div>
                    <div class="feature-box">
                        <i class="fa-solid fa-chart-pie"></i>
                        <h4>Monitoring</h4>
                        <p>Lihat ringkasan performa aset, stok, dan tingkat kerusakan secara real time.</p>
                    </div>
                    <div class="feature-box">
                        <i class="fa-solid fa-shield-halved"></i>
                        <h4>Terpercaya</h4>
                        <p>Semua data dikelola secara konsisten agar proses operasional lebih aman.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
