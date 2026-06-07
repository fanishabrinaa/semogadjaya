<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Contact - Semoga Djaya Coffee</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">



<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --green-dark: #0b482b;
        --green-mid: #1a7a4a;
        --green-light: #e8f5ee;
        --green-muted: #4a7c5e;
        --green-border: #b6dfc8;
        --cream: #faf9f6;
        --text-dark: #1a1a1a;
        --text-muted: #6b7b72;
        --radius-sm: 12px;
        --radius-md: 20px;
        --radius-lg: 32px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        background: var(--cream);
        font-family: 'Poppins', sans-serif;
        color: var(--text-dark);
        overflow-x: hidden;
    }

    /* ─── NAVBAR ─────────────────────────────────── */
    .custom-navbar { background: transparent; position: fixed; width: 100%; top: 20px; z-index: 9999; }

    .nav-wrapper {
        width: 100%; background: rgba(255, 255, 255, 0.19);
       
        border-radius: 80px; padding: 16px 40px;
        display: flex; justify-content: space-between; align-items: center;
        position: relative; border: 1px solid rgba(15,81,50,0.08);
        box-shadow: 0 4px 24px rgba(15,81,50,0.07);
    }

    .nav-left, .nav-right { display: flex; align-items: center; gap: 36px; }
    .nav-center { position: absolute; left: 50%; transform: translateX(-50%); }

    .navbar-logo { font-size: 22px; font-weight: 700; text-decoration: none; color: var(--green-dark); white-space: nowrap; letter-spacing: 0.5px; }

    .nav-item-link {
        text-decoration: none; color: #444; font-weight: 500; font-size: 13px;
        text-transform: uppercase; letter-spacing: 1.2px; transition: color 0.25s; position: relative;
    }

    .nav-item-link::after { content: ''; position: absolute; bottom: -3px; left: 0; width: 0; height: 1.5px; background: var(--green-dark); transition: width 0.25s; }
    .nav-item-link:hover { color: var(--green-dark); }
    .nav-item-link:hover::after { width: 100%; }
    .nav-item-link.active { color: var(--green-dark); }
    .nav-item-link.active::after { width: 100%; }

    @media(max-width:768px) {
        .nav-wrapper { flex-direction: column; gap: 16px; border-radius: 28px; padding: 22px 24px; }
        .nav-center { position: static; transform: none; order: -1; }
        .nav-left, .nav-right { flex-wrap: wrap; justify-content: center; gap: 18px; }
        .navbar-logo { font-size: 20px; }
    }

    /* ─── FORE-STYLE HERO (foto kiri, teks kanan) ── */
    .fore-hero {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 100vh;
        padding-top: 100px;
    }

    .fore-hero-img {
        position: relative;
        overflow: hidden;
    }

    .fore-hero-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .fore-hero-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 80px 72px 80px 64px;
        background: white;
    }

    .fore-eyebrow {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 13px;
        font-weight: 500;
        color: var(--green-dark);
        margin-bottom: 28px;
    }

    .fore-eyebrow::before {
        content: '';
        width: 40px;
        height: 2px;
        background: var(--green-dark);
        flex-shrink: 0;
    }

    .fore-hero-content h1 {
        font-size: 80px;
        font-weight: 800;
        color: var(--green-dark);
        line-height: 0.95;
        letter-spacing: -2px;
        margin-bottom: 32px;
    }

    .fore-hero-content p {
        font-size: 20px;
        color: var(--text-muted);
        line-height: 1.8;
        font-weight: 300;
        max-width: 440px;
    }

    @media(max-width:900px) {
        .fore-hero { grid-template-columns: 1fr; padding-top: 120px; }
        .fore-hero-img { height: 50vh; }
        .fore-hero-content { padding: 48px 28px; }
        .fore-hero-content h1 { font-size: 52px; }
        .fore-hero-content p { font-size: 16px; }
    }

    /* ─── STATS BAR ──────────────────────────────── */
    .stats-bar { background: var(--green-dark); padding: 36px 0; }

    .stats-inner { display: flex; justify-content: center; flex-wrap: wrap; }

    .stat-item { text-align: center; padding: 0 48px; border-right: 1px solid rgba(255,255,255,0.12); }
    .stat-item:last-child { border-right: none; }
    .stat-item .num { font-size: 38px; font-weight: 800; color: white; line-height: 1; }
    .stat-item .lbl { font-size: 11px; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.5); margin-top: 6px; }

    @media(max-width:768px) {
        .stat-item { padding: 16px 24px; border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); width: 50%; }
        .stat-item:nth-child(2) { border-right: 1px solid rgba(255,255,255,0.1); }
        .stat-item:last-child { border-bottom: none; }
        .stat-item:nth-child(3) { border-bottom: none; }
    }

    /* ─── SECTION COMMON ─────────────────────────── */
    .section-label { font-size: 11px; letter-spacing: 3.5px; text-transform: uppercase; color: var(--green-mid); font-weight: 500; margin-bottom: 16px; display: block; }

    .section-title { font-size: 52px; font-weight: 700; color: var(--green-dark); line-height: 1.05; margin-bottom: 20px; }

    @media(max-width:768px) { .section-title { font-size: 36px; } }

    /* ─── FEATURE CARDS ──────────────────────────── */
    .features-section { padding: 100px 0; background: var(--cream); }

    .feature-card {
        background: white; padding: 40px 32px;
        border-radius: var(--radius-lg); height: 100%;
        border: 1px solid rgba(15,81,50,0.06);
        transition: border-color 0.3s, transform 0.3s, box-shadow 0.3s;
        position: relative; overflow: hidden;
    }

    .feature-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--green-dark), var(--green-mid));
        opacity: 0; transition: opacity 0.3s;
    }

    .feature-card:hover { border-color: var(--green-border); transform: translateY(-6px); box-shadow: 0 16px 48px rgba(15,81,50,0.08); }
    .feature-card:hover::before { opacity: 1; }

    .feature-icon-wrap {
        width: 64px; height: 64px; background: var(--green-light);
        border-radius: 18px; display: flex; justify-content: center;
        align-items: center; margin-bottom: 24px; transition: background 0.3s;
    }

    .feature-card:hover .feature-icon-wrap { background: var(--green-dark); }
    .feature-icon-wrap i { font-size: 28px; color: var(--green-dark); transition: color 0.3s; }
    .feature-card:hover .feature-icon-wrap i { color: white; }
    .feature-card h3 { font-size: 20px; font-weight: 700; color: var(--green-dark); margin-bottom: 12px; }
    .feature-card p { color: var(--text-muted); line-height: 1.8; font-size: 14px; }

    /* ─── STORY SECTION (foto kanan, teks kiri) ───── */
    .story-split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 600px;
        background: white;
    }

    .story-split-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 80px 72px 80px 0;
    }

    .story-split-img {
        overflow: hidden;
    }

    .story-split-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    @media(max-width:900px) {
        .story-split { grid-template-columns: 1fr; }
        .story-split-img { height: 340px; order: -1; }
        .story-split-content { padding: 48px 28px; }
    }

    .story-block { background: var(--cream); padding: 64px; border-radius: var(--radius-lg); border: 1px solid rgba(15,81,50,0.07); }
    .story-block h2 { font-size: 36px; font-weight: 700; color: var(--green-dark); margin-bottom: 20px; }
    .story-block p { font-size: 15px; color: var(--text-muted); line-height: 2; }
    .story-block ul { color: var(--text-muted); line-height: 2.4; font-size: 15px; }
    .story-block hr { border-color: var(--green-light); margin: 48px 0; }

    @media(max-width:768px) { .story-block { padding: 36px 24px; } }

    /* ─── TIMELINE ───────────────────────────────── */
    .timeline { position: relative; padding-left: 32px; margin-top: 8px; }
    .timeline::before { content: ''; position: absolute; left: 7px; top: 6px; bottom: 6px; width: 2px; background: var(--green-border); }
    .timeline-item { position: relative; margin-bottom: 32px; }
    .timeline-item::before { content: ''; position: absolute; left: -29px; top: 6px; width: 12px; height: 12px; border-radius: 50%; background: var(--green-dark); border: 2px solid white; box-shadow: 0 0 0 2px var(--green-border); }
    .timeline-item .year { font-size: 11px; letter-spacing: 2px; text-transform: uppercase; color: var(--green-mid); font-weight: 600; margin-bottom: 4px; }
    .timeline-item p { font-size: 14px; color: var(--text-muted); line-height: 1.8; margin: 0; }

    /* ─── VALUES ─────────────────────────────────── */
    .values-section { padding: 10px 0 90px; background: var(--cream); }

    .value-card {
        background: white; border-radius: var(--radius-lg);
        padding: 40px 28px; text-align: center; height: 100%;
        border: 1px solid rgba(15,81,50,0.06); transition: all 0.3s;
    }

    .value-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(15,81,50,0.09); border-color: var(--green-border); }
    .value-icon { font-size: 36px; margin-bottom: 16px; display: block; }
    .value-card h4 { font-size: 18px; font-weight: 700; color: var(--green-dark); margin-bottom: 10px; }
    .value-card p { font-size: 13px; color: var(--text-muted); line-height: 1.8; }

    /* ─── QUOTE SECTION ──────────────────────────── */
    .quote-section { padding: 100px 0; background: var(--green-dark); text-align: center; }
    .quote-text { font-size: 28px; font-weight: 300; color: white; line-height: 1.7; max-width: 700px; margin: 0 auto; font-style: italic; }
    .quote-author { font-size: 13px; color: rgba(255,255,255,0.5); letter-spacing: 2px; text-transform: uppercase; margin-top: 24px; }

    @media(max-width:768px) { .quote-text { font-size: 20px; } }

    /* ─── CTA ────────────────────────────────────── */
    .cta-strip { background: white; padding: 80px 20px; text-align: center; border-bottom: 1px solid var(--green-light); }
    .cta-strip h3 { font-size: 40px; font-weight: 700; color: var(--green-dark); margin-bottom: 12px; }
    .cta-strip p { color: var(--text-muted); font-size: 16px; margin-bottom: 32px; }

    .btn-cta { background: var(--green-dark); color: white; border: none; border-radius: 50px; padding: 14px 40px; font-size: 13px; font-weight: 600; letter-spacing: 1px; text-decoration: none; text-transform: uppercase; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; }
    .btn-cta:hover { background: var(--green-mid); color: white; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(15,81,50,0.3); }

    .btn-cta-outline { background: transparent; color: var(--green-dark); border: 1.5px solid var(--green-border); border-radius: 50px; padding: 14px 40px; font-size: 13px; font-weight: 600; letter-spacing: 1px; text-decoration: none; text-transform: uppercase; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; }
    .btn-cta-outline:hover { background: var(--green-dark); color: white; border-color: var(--green-dark); }

    .badge-value { background: var(--green-light); color: var(--green-dark); padding: 10px 22px; border-radius: 50px; font-size: 13px; font-weight: 500; border: 1px solid var(--green-border); }

    /* ─── FOOTER ─────────────────────────────────── */
    .sdj-footer { background: #fff; padding: 64px 0 28px; border-top: 1px solid #e8f5ee; }
    .sdj-container { max-width: 1200px; margin: 0 auto; padding: 0 32px; }
    .sdj-grid { display: grid; grid-template-columns: 1.6fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 48px; }
    .sdj-logo { font-size: 28px; font-weight: 800; color: #0f5132; line-height: 1.1; }
    .sdj-tagline { font-size: 13px; color: #4a7c5e; line-height: 1.8; margin: 12px 0 0; }
    .sdj-quote { font-size: 12px; color: #9bbfaa; font-style: italic; line-height: 1.7; padding-left: 10px; border-left: 2px solid #b6dfc8; margin-top: 14px; }
    .sdj-col-title { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #1a7a4a; margin-bottom: 16px; }
    .sdj-nav-link { display: block; font-size: 13px; color: #4a7c5e; text-decoration: none; margin-bottom: 10px; transition: color 0.2s; }
    .sdj-nav-link:hover { color: #0f5132; }
    .sdj-contact-row { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px; }
    .sdj-contact-icon { width: 28px; height: 28px; background: #e8f5ee; border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .sdj-contact-icon i { font-size: 13px; color: #0f5132; }
    .sdj-contact-text { font-size: 13px; color: #4a7c5e; line-height: 1.6; padding-top: 4px; }
    .sdj-map { margin-top: 12px; border-radius: 12px; overflow: hidden; border: 1px solid #b6dfc8; }
    .sdj-map iframe { display: block; width: 100%; height: 110px; border: none; }
    .sdj-hours-box { background: #f5fbf7; border: 1px solid #b6dfc8; border-radius: 12px; padding: 14px 16px; }
    .sdj-hours-row { display: flex; justify-content: space-between; font-size: 12px; color: #4a7c5e; padding: 5px 0; border-bottom: 1px solid #e8f5ee; }
    .sdj-hours-row:last-child { border-bottom: none; }
    .sdj-hours-row span:last-child { color: #0f5132; font-weight: 600; }
    .sdj-hours-note { font-size: 11px; color: #9bbfaa; margin-top: 10px; text-align: center; }
    .sdj-social-row { display: flex; gap: 8px; margin-top: 20px; }
    .sdj-social-btn { width: 36px; height: 36px; border-radius: 9px; background: #e8f5ee; border: 1px solid #b6dfc8; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: background 0.2s; }
    .sdj-social-btn:hover { background: #c8edda; }
    .sdj-social-btn i { font-size: 15px; color: #0f5132; }
    .sdj-social-handle { font-size: 11px; color: #4a7c5e; margin-top: 10px; }
    .sdj-social-handle a { color: #0f5132; text-decoration: none; font-weight: 600; }
    .sdj-strip { border-top: 1px solid #e8f5ee; border-bottom: 1px solid #e8f5ee; padding: 18px 0; margin-bottom: 20px; display: flex; justify-content: center; gap: 40px; flex-wrap: wrap; }
    .sdj-strip-item { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #4a7c5e; }
    .sdj-strip-item i { font-size: 15px; color: #1a7a4a; }
    .sdj-divider { border: none; border-top: 1px solid #e8f5ee; margin: 0 0 20px; }
    .sdj-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; }
    .sdj-copy { font-size: 12px; color: #9bbfaa; margin: 0; }
    .sdj-badge-f { font-size: 11px; background: #e8f5ee; color: #0f5132; padding: 4px 12px; border-radius: 50px; border: 1px solid #b6dfc8; }

    @media(max-width:768px) { .sdj-grid { grid-template-columns: 1fr 1fr; gap: 28px; } .sdj-strip { gap: 20px; } .sdj-bottom { justify-content: center; text-align: center; } }
    @media(max-width:480px) { .sdj-grid { grid-template-columns: 1fr; } }
</style>

<!-- NAVBAR -->
<nav class="navbar custom-navbar">
    <div class="container">
        <div class="nav-wrapper">
            <div class="nav-left">
                <a href="/" class="nav-item-link">Beranda</a>
                <a href="/about" class="nav-item-link active">Tentang Kami</a>
            </div>
            <div class="nav-center">
                <a href="/" class="navbar-logo">SEMOGA DJAYA COFFEE</a>
            </div>
            <div class="nav-right">
                <a href="/order" class="nav-item-link">Pesan Sekarang</a>
                <a href="/contact" class="nav-item-link">Kontak</a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO — FOTO KIRI, TEKS KANAN (FORE STYLE) -->
<div class="fore-hero">

    <!-- FOTO KEDAI ASLI -->
    <div class="fore-hero-img">
        <img src="/images/about.jpeg" alt="Semoga Djaya Coffee">
    </div>

    <!-- TEKS KANAN -->
    <div class="fore-hero-content">
        <div class="fore-eyebrow">Tentang Kami</div>
        <h1>Cerita<br>Kami</h1>
        <p>
            Semoga Djaya Coffee hadir sebagai tempat nyaman untuk menikmati kopi,
            berkumpul, berbagi cerita, dan menciptakan suasana hangat bersama.
        </p>
    </div>

</div>

<!-- STATS BAR -->
<div class="stats-bar">
    <div class="container">
        <div class="stats-inner">
            <div class="stat-item">
                <div class="num">20+</div>
                <div class="lbl">Menu Pilihan</div>
            </div>
            <div class="stat-item">
                <div class="num">1K+</div>
                <div class="lbl">Pelanggan</div>
            </div>
            <div class="stat-item">
                <div class="num">4.9</div>
                <div class="lbl">Rating</div>
            </div>
            <div class="stat-item">
                <div class="num">2020</div>
                <div class="lbl">Tahun Berdiri</div>
            </div>
        </div>
    </div>
</div>

<!-- FEATURE CARDS -->
<section class="features-section">
    <div class="container">

        <div class="text-center mb-5">
            <span class="section-label">Keunggulan Kami</span>
            <h2 class="section-title">Mengapa Pilih<br>Semoga Djaya?</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="bi bi-cup-hot-fill"></i></div>
                    <h3>Kopi Berkualitas</h3>
                    <p>Menggunakan biji kopi pilihan dengan rasa autentik untuk memberikan pengalaman ngopi terbaik.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="bi bi-people-fill"></i></div>
                    <h3>Tempat Nyaman</h3>
                    <p>Cocok untuk nongkrong, belajar, berdiskusi, maupun menikmati waktu santai bersama teman.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="bi bi-heart-fill"></i></div>
                    <h3>Suasana Bersahabat</h3>
                    <p>Memberikan pelayanan hangat agar setiap pengunjung merasa seperti di rumah sendiri.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="bi bi-wifi"></i></div>
                    <h3>Free Wi-Fi</h3>
                    <p>Koneksi internet cepat tersedia untuk kamu yang mau kerja, belajar, atau streaming sambil ngopi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="bi bi-cash-coin"></i></div>
                    <h3>Harga Terjangkau</h3>
                    <p>Kualitas premium dengan harga yang ramah di kantong. Nikmati kopi enak tanpa harus khawatir.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="bi bi-clock-fill"></i></div>
                    <h3>Buka Setiap Hari</h3>
                    <p>Kami buka 7 hari seminggu dari pukul 09.00 hingga 22.00. Kapanpun kamu butuh, kami ada.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- STORY SECTION — teks kiri, foto kanan (Fore style split) -->
<div class="story-split">

    <div class="story-split-content">
        <div style="padding-left: 80px;">
            <span class="section-label">Cerita Kami</span>
            <h2 class="section-title">Awal<br>Berdirinya</h2>
            <p style="font-size:15px; color:var(--text-muted); line-height:2; max-width:460px;">
                Semoga Djaya Coffee didirikan sebagai tempat berkumpul dan bersantai
                bagi masyarakat Bangsri, khususnya anak muda dan pecinta kopi.
                Nama "Semoga Djaya" dipilih sebagai harapan agar usaha ini terus berkembang,
                membawa keberuntungan, dan memberi manfaat bagi banyak orang.
            </p>
            <p style="font-size:15px; color:var(--text-muted); line-height:2; max-width:460px; margin-top:16px;">
                Awalnya toko ini dibangun karena melihat semakin banyak masyarakat
                yang membutuhkan tempat nyaman untuk berkumpul, berdiskusi,
                belajar, maupun menikmati kopi dengan suasana santai.
            </p>
        </div>
    </div>

    <div class="story-split-img">
        <img src="/images/about2.jpeg" alt="Suasana Semoga Djaya Coffee">
    </div>

</div>

<!-- DETAIL CERITA -->
<section style="padding: 80px 0; background: var(--cream);">
    <div class="container">
        <div class="story-block">

            <h2>Tujuan Dibangunnya Toko</h2>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li>Menjadi tempat nongkrong yang nyaman dan ramah.</li>
                        <li>Menyediakan minuman dan makanan dengan harga terjangkau.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li>Mendukung budaya minum kopi dan interaksi sosial.</li>
                        <li>Membuka peluang usaha dan lapangan pekerjaan.</li>
                    </ul>
                </div>
            </div>

            <hr>

            <h2>Perkembangan Toko</h2>
            <p>Seiring waktu, Semoga Djaya Coffee mulai dikenal masyarakat karena suasananya yang nyaman dan pelayanan yang baik. Pengunjung tidak hanya datang untuk menikmati kopi, tetapi juga untuk berkumpul bersama teman, mengerjakan tugas, atau mengadakan diskusi kecil.</p>
            <p class="mt-3">Dengan berkembangnya tren coffee shop di Indonesia, toko ini ikut menjadi bagian dari perkembangan budaya nongkrong modern di daerah Bangsri.</p>

            <!-- TIMELINE -->
            <div class="mt-5">
                <span class="section-label">Perjalanan Kami</span>
                <div class="timeline mt-3">
                    <div class="timeline-item">
                        <div class="year">2020</div>
                        <p>Semoga Djaya Coffee resmi dibuka di Bangsri, Jepara, dengan konsep tempat ngopi yang hangat dan terjangkau.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="year">2021</div>
                        <p>Mulai dikenal masyarakat sekitar. Pengunjung bertambah, menu diperluas, dan suasana makin ramai.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="year">2022 – 2023</div>
                        <p>Menjadi salah satu spot favorit nongkrong anak muda Bangsri. Komunitas lokal makin sering berkumpul di sini.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="year">2024 – Sekarang</div>
                        <p>Terus berkembang, meningkatkan kualitas pelayanan, dan hadir di media sosial untuk menjangkau lebih banyak pelanggan.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- VALUES SECTION -->
<section class="values-section">
    <div class="container">

        <div class="text-center mb-5">
            <span class="section-label">Nilai Kami</span>
            <h2 class="section-title">Yang Kami<br>Pegang Teguh</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="value-card">
                    <span class="value-icon">🌿</span>
                    <h4>Nyaman</h4>
                    <p>Setiap sudut dirancang agar kamu betah berlama-lama.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="value-card">
                    <span class="value-icon">💡</span>
                    <h4>Kreatif</h4>
                    <p>Terus berinovasi dalam menu dan pengalaman pelanggan.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="value-card">
                    <span class="value-icon">🤝</span>
                    <h4>Bersahabat</h4>
                    <p>Pelayanan hangat yang membuat kamu merasa diterima.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="value-card">
                    <span class="value-icon">✨</span>
                    <h4>Positif</h4>
                    <p>Energi positif yang kami jaga di setiap momen bersama.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- QUOTE SECTION -->
<section class="quote-section">
    <div class="container">
        <span class="section-label" style="color:rgba(255,255,255,0.4); display:block; text-align:center; margin-bottom:24px;">Filosofi Kami</span>
        <p class="quote-text">
            "Kami tidak hanya menyajikan kopi — kami menciptakan ruang di mana setiap orang
            bisa merasa diterima, nyaman, dan pulang dengan kenangan yang hangat."
        </p>
        <p class="quote-author">— Semoga Djaya Coffee, Bangsri</p>
    </div>
</section>

<!-- CTA STRIP -->
<section class="cta-strip">
    <div class="container">
        <h3>Yuk Mampir ke Semoga Djaya!</h3>
        <p>Buka setiap hari 09.00 – 22.00 · Bangsri, Jepara, Jawa Tengah</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="/order" class="btn-cta">
                <i class="bi bi-bag-fill"></i> Pesan Sekarang
            </a>
            <a href="https://wa.me/6282135443492" target="_blank" class="btn-cta-outline">
                <i class="bi bi-whatsapp"></i> Chat WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="sdj-footer">
    <div class="sdj-container">
        <div class="sdj-grid">
            <div>
                <div>
                <div class="sdj-logo">SEMOGA<br>DJAYA</div>
                <p class="sdj-tagline">Tempat nyaman untuk menikmati kopi, berbagi cerita, dan menciptakan suasana hangat bersama.</p>
                <div class="sdj-quote">"Hidup terlalu singkat untuk kopi yang biasa-biasa saja."</div>
                <div class="sdj-social-row">
                    <a href="https://instagram.com/warungkopi.semogadjaya" class="sdj-social-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="sdj-social-btn" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                    <a href="https://wa.me/6282135443492" class="sdj-social-btn" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                </div>
                <div class="sdj-social-handle">Instagram: <a href="https://instagram.com/warungkopi.semogadjaya">@warungkopi.semogadjaya</a></div>
            </div>
        
            </div>
            <div>
                <p class="sdj-col-title">Navigasi</p>
                <a href="/" class="sdj-nav-link">&#8594; Beranda</a>
                <a href="/about" class="sdj-nav-link">&#8594; Tentang Kami</a>
                <a href="/order" class="sdj-nav-link">&#8594; Menu Kami</a>
                <a href="/order" class="sdj-nav-link">&#8594; Pesan Sekarang</a>
                <a href="/contact" class="sdj-nav-link">&#8594; Kontak</a>
            </div>
            <div>
                <p class="sdj-col-title">Hubungi Kami</p>
                <div class="sdj-contact-row">
                    <div class="sdj-contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="sdj-contact-text">Bangsri, Jepara,<br>Jawa Tengah</div>
                </div>
                <div class="sdj-contact-row">
                    <div class="sdj-contact-icon"><i class="bi bi-whatsapp"></i></div>
                    <div class="sdj-contact-text">082135443492</div>
                </div>
                <div class="sdj-contact-row">
                    <div class="sdj-contact-icon"><i class="bi bi-envelope-fill"></i></div>
                    <div class="sdj-contact-text">putradwi091290@gmail.com</div>
                </div>
                <div class="sdj-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1023.9032860868631!2d110.76626352085022!3d-6.519937897639012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e712384c78def89%3A0x6a609a23e1716abe!2sSemoga%20Jaya%20Coffee!5e0!3m2!1sen!2sid!4v1779170951744!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div>
                <p class="sdj-col-title">Jam Buka</p>
                <div class="sdj-hours-box">
                    <div class="sdj-hours-row"><span>Senin</span><span>09.00 – 22.00</span></div>
                    <div class="sdj-hours-row"><span>Selasa</span><span>09.00 – 22.00</span></div>
                    <div class="sdj-hours-row"><span>Rabu</span><span>09.00 – 22.00</span></div>
                    <div class="sdj-hours-row"><span>Kamis</span><span>09.00 – 22.00</span></div>
                    <div class="sdj-hours-row"><span>Jumat</span><span>09.00 – 22.00</span></div>
                    <div class="sdj-hours-row"><span>Sabtu</span><span>09.00 – 22.00</span></div>
                    <div class="sdj-hours-row"><span>Minggu</span><span>09.00 – 22.00</span></div>
                </div>
                <p class="sdj-hours-note">Buka setiap hari tanpa libur</p>
            </div>
        </div>

        <div class="sdj-strip">
            <div class="sdj-strip-item"><i class="bi bi-cup-hot-fill"></i><span>Premium Coffee</span></div>
            <div class="sdj-strip-item"><i class="bi bi-people-fill"></i><span>Tempat Nongkrong</span></div>
            
            <div class="sdj-strip-item"><i class="bi bi-p-circle-fill"></i><span>Area Parkir</span></div>
            <div class="sdj-strip-item"><i class="bi bi-house-heart-fill"></i><span>Tempat Nyaman</span></div>
        </div>

        <hr class="sdj-divider">

        <div class="sdj-bottom">
            <p class="sdj-copy">© 2026 Semoga Djaya Coffee — All Rights Reserved</p>
            <span class="sdj-badge-f">Jepara, Jawa Tengah</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
