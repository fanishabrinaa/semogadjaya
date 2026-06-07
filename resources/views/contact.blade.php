<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Contact - Semoga Djaya Coffee</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --green-dark: #0f5132;
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

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background: var(--cream);
        font-family: 'Poppins', sans-serif;
        color: var(--text-dark);
        overflow-x: hidden;
    }

    /* NAVBAR */
    .custom-navbar {
        background: transparent;
        position: fixed;
        width: 100%;
        top: 20px;
        z-index: 9999;
    }

    .nav-wrapper {
        width: 100%;
        background: rgba(255, 255, 255, 0.19);
        
        border-radius: 80px;
        padding: 16px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        border: 1px solid rgba(15,81,50,0.08);
        box-shadow: 0 4px 24px rgba(15,81,50,0.07);
    }

    .nav-left,
    .nav-right {
        display: flex;
        align-items: center;
        gap: 36px;
    }

    .nav-center {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .navbar-logo {
        font-size: 22px;
        font-weight: 700;
        text-decoration: none;
        color: var(--green-dark);
        white-space: nowrap;
    }

    .nav-item-link {
        text-decoration: none;
        color: #444;
        font-weight: 500;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        transition: .25s;
        position: relative;
    }

    .nav-item-link::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 1.5px;
        background: var(--green-dark);
        transition: .25s;
    }

    .nav-item-link:hover::after,
    .nav-item-link.active::after {
        width: 100%;
    }

    .nav-item-link.active,
    .nav-item-link:hover {
        color: var(--green-dark);
    }

    /* HEADER */
    .simple-header {
        padding-top: 180px;
        padding-bottom: 70px;
        text-align: center;
        background: var(--cream);
    }

    .section-label {
        font-size: 11px;
        letter-spacing: 3.5px;
        text-transform: uppercase;
        color: var(--green-mid);
        font-weight: 500;
        margin-bottom: 16px;
        display: block;
    }

    .section-title {
        font-size: 58px;
        font-weight: 700;
        color: var(--green-dark);
        line-height: 1.05;
        margin-bottom: 18px;
    }

    .header-desc {
        color: var(--text-muted);
        font-size: 15px;
    }

    /* CONTACT */
    .contact-section {
        padding-bottom: 120px;
    }

    .info-card {
        background: white;
        border: 1px solid rgba(15,81,50,0.08);
        border-radius: var(--radius-lg);
        padding: 36px 32px;
        display: flex;
        gap: 20px;
        transition: .3s;
        height: 100%;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 48px rgba(15,81,50,0.1);
    }

    .info-icon {
        width: 52px;
        height: 52px;
        background: var(--green-light);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: var(--green-dark);
    }

    .info-card h5 {
        font-size: 13px;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 6px;
    }

    .info-card p,
    .info-card a {
        font-size: 15px;
        font-weight: 600;
        color: var(--green-dark);
        text-decoration: none;
    }

    /* FORM */
    .form-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 52px 48px;
        box-shadow: 0 8px 40px rgba(15,81,50,0.06);
    }

    .form-card h3 {
        font-size: 32px;
        font-weight: 700;
        color: var(--green-dark);
    }

    .form-card .sub {
        font-size: 14px;
        color: var(--text-muted);
        margin: 12px 0 36px;
    }

    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .form-group-custom {
        margin-bottom: 22px;
    }

    .form-group-custom label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
        color: var(--text-muted);
    }

    .form-group-custom input,
    .form-group-custom textarea,
    .form-group-custom select {
        width: 100%;
        padding: 14px 18px;
        border: 1.5px solid rgba(15,81,50,0.12);
        border-radius: var(--radius-sm);
        font-size: 14px;
        background: var(--cream);
        outline: none;
    }

    .form-group-custom textarea {
        min-height: 140px;
        resize: vertical;
    }

    .btn-submit {
        width: 100%;
        border: none;
        background: var(--green-dark);
        color: white;
        border-radius: 50px;
        padding: 16px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-submit:hover {
        background: var(--green-mid);
    }

    /* FOOTER */
    .sdj-footer{
        background:#0f5132;
        color:white;
        padding:90px 0 40px;
        margin-top:100px;
    }

    .sdj-container{
        width:min(1200px,92%);
        margin:auto;
    }

    .sdj-grid{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:50px;
    }

    .sdj-logo{
        font-size:34px;
        font-weight:800;
        line-height:1;
        margin-bottom:20px;
    }

    .sdj-tagline,
    .sdj-quote,
    .sdj-copy,
    .sdj-hours-note{
        color:rgba(255,255,255,0.7);
        font-size:14px;
        line-height:1.8;
    }

    .sdj-col-title{
        font-size:15px;
        font-weight:700;
        margin-bottom:20px;
    }

    .sdj-nav-link{
        display:block;
        color:rgba(255,255,255,0.7);
        text-decoration:none;
        margin-bottom:12px;
    }

    .sdj-nav-link:hover{
        color:white;
    }

    .sdj-contact-row{
        display:flex;
        gap:12px;
        margin-bottom:16px;
    }

    .sdj-hours-row{
        display:flex;
        justify-content:space-between;
        margin-bottom:10px;
        font-size:14px;
        color:rgba(255,255,255,0.75);
    }

    .sdj-divider{
        border:none;
        border-top:1px solid rgba(255,255,255,0.1);
        margin:40px 0 24px;
    }

    .sdj-bottom{
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
    }

    .sdj-badge{
        background:rgba(255,255,255,0.1);
        padding:8px 18px;
        border-radius:50px;
        font-size:12px;
    }

    @media(max-width:992px){
        .sdj-grid{
            grid-template-columns:1fr 1fr;
        }
    }

    @media(max-width:768px){
        .form-row-2{
            grid-template-columns:1fr;
        }

        .section-title{
            font-size:42px;
        }

        .sdj-grid{
            grid-template-columns:1fr;
        }

        .nav-wrapper{
            flex-direction:column;
            gap:16px;
            border-radius:28px;
            padding:22px 24px;
        }

        .nav-center{
            position:static;
            transform:none;
        }
    }
    /* FOOTER */

.sdj-footer { background: #fff; padding: 64px 0 28px; border-top: 1px solid #e8f5ee; }
.sdj-container { max-width: 1200px; margin: 0 auto; padding: 0 32px; }

.sdj-grid {
  display: grid;
  grid-template-columns: 1.6fr 1fr 1fr 1fr;
  gap: 40px;
  margin-bottom: 48px;
}

.sdj-logo { font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 800; color: #0f5132; line-height: 1.1; }
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

.sdj-social-row { display: flex; gap: 8px; }
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
.sdj-badge { font-size: 11px; background: #e8f5ee; color: #0f5132; padding: 4px 12px; border-radius: 50px; border: 1px solid #b6dfc8; }

@media (max-width: 768px) {
  .sdj-grid { grid-template-columns: 1fr 1fr; gap: 28px; }
  .sdj-strip { gap: 20px; }
  .sdj-bottom { justify-content: center; text-align: center; }
}

@media (max-width: 480px) {
  .sdj-grid { grid-template-columns: 1fr; }
}

    
</style>

<!-- NAVBAR -->
<nav class="navbar custom-navbar">
    <div class="container">
        <div class="nav-wrapper">

            <div class="nav-left">
                <a href="/" class="nav-item-link">Beranda</a>
                <a href="/about" class="nav-item-link">Tentang Kami</a>
            </div>

            <div class="nav-center">
                <a href="/" class="navbar-logo">SEMOGA DJAYA COFFEE</a>
            </div>

            <div class="nav-right">
                <a href="/order" class="nav-item-link">Pesan Sekarang</a>
                <a href="/contact" class="nav-item-link active">Kontak</a>
            </div>

        </div>
    </div>
</nav>

<!-- HEADER -->
<div class="simple-header">
    <div class="container">
        <p class="section-label">Semoga Djaya Coffee</p>
        <h1 class="section-title">Hubungi Kami</h1>
        <p class="header-desc">
            Ada pertanyaan atau ingin reservasi? Kami siap membantu ☕
        </p>
    </div>
</div>

<!-- CONTACT -->
<section class="contact-section">
    <div class="container">

        <div class="row g-4 mb-5">

            <div class="col-md-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <h5>Alamat</h5>
                        <p>Bangsri, Jepara, Jawa Tengah</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <div>
                        <h5>WhatsApp</h5>
                        <a href="https://wa.me/6282135443492">
                            082135443492
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-instagram"></i>
                    </div>
                    <div>
                        <h5>Instagram</h5>
                        <a href="#">@semogadjayacoffee</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="form-card">

            <h3>Kirim Pesan</h3>

            <p class="sub">
                Isi form di bawah ini, kami akan segera merespons.
            </p>

            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form id="contactForm">

                <div class="form-row-2">

                    <div class="form-group-custom">
                        <label>Nama</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group-custom">
                        <label>WhatsApp</label>
                        <input type="text" name="phone" required>
                    </div>

                </div>

                <div class="form-group-custom">
                    <label>Topik</label>

                    <select name="topic" required>
                        <option value="">Pilih Topik</option>
                        <option>Pertanyaan Menu</option>
                        <option>Reservasi</option>
                        <option>Kerja Sama</option>
                        <option>Kritik & Saran</option>
                    </select>
                </div>

                <div class="form-group-custom">
                    <label>Pesan</label>

                    <textarea name="message" required></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Kirim Pesan
                </button>

            </form>

        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="sdj-footer">
  <div class="sdj-container">
    <div class="sdj-grid">

      <!-- KOLOM 1: BRAND -->
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

      <!-- KOLOM 2: NAVIGASI -->
      <div>
        <p class="sdj-col-title">Navigasi</p>
        <a href="/" class="sdj-nav-link">&#8594; Beranda</a>
        <a href="/about" class="sdj-nav-link">&#8594; Tentang Kami</a>
        <a href="#menu" class="sdj-nav-link">&#8594; Menu Kami</a>
        <a href="/order" class="sdj-nav-link">&#8594; Pesan Sekarang</a>
        <a href="/contact" class="sdj-nav-link">&#8594; Kontak</a>
      </div>

      <!-- KOLOM 3: KONTAK -->
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
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1023.9032860868631!2d110.76626352085022!3d-6.519937897639012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e712384c78def89%3A0x6a609a23e1716abe!2sSemoga%20Jaya%20Coffee!5e0!3m2!1sen!2sid!4v1779170951744!5m2!1sen!2sid" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </div>

      <!-- KOLOM 4: JAM OPERASIONAL -->
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

    <!-- STRIP FITUR -->
    <div class="sdj-strip">
      <div class="sdj-strip-item"><i class="bi bi-cup-hot-fill"></i><span>Premium Coffee</span></div>
      <div class="sdj-strip-item"><i class="bi bi-people-fill"></i><span>Tempat Nongkrong</span></div>
      
      <div class="sdj-strip-item"><i class="bi bi-p-circle-fill"></i><span>Area Parkir</span></div>
      <div class="sdj-strip-item"><i class="bi bi-house-heart-fill"></i><span>Tempat Nyaman</span></div>
    </div>

    <hr class="sdj-divider">

    <!-- BOTTOM -->
    <div class="sdj-bottom">
      <p class="sdj-copy">© 2026 Semoga Djaya Coffee — All Rights Reserved</p>
      <span class="sdj-badge">Jepara, Jawa Tengah</span>
    </div>

  </div>
</footer>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('contactForm').addEventListener('submit', function(e){

    e.preventDefault();

    let nama = document.querySelector('[name="name"]').value;
    let phone = document.querySelector('[name="phone"]').value;
    let topic = document.querySelector('[name="topic"]').value;
    let message = document.querySelector('[name="message"]').value;

    let text =
`Halo Semoga Djaya Coffee

Nama: ${nama}
No WA: ${phone}
Topik: ${topic}

Pesan:
${message}`;

    let wa = "6282135443492";

    window.open(
        `https://wa.me/${wa}?text=${encodeURIComponent(text)}`,
        '_blank'
    );

});
</script>
</body>
</html>
