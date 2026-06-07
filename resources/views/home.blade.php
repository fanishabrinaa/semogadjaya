<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEMOGA DJAYA COFFEE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

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

    * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }

    body {
        background: var(--cream);
        overflow-x: hidden;
        font-family: 'Poppins', sans-serif;
        color: var(--text-dark);
    }

    /* ─── NAVBAR ─────────────────────────────── */
    .custom-navbar { background: transparent; position: fixed; width: 100%; top: 20px; z-index: 9999; }

    .nav-wrapper {
        width: 100%; background: rgba(255,255,255,0.65);
        border-radius: 80px; padding: 16px 40px;
        display: flex; justify-content: space-between; align-items: center;
        position: relative; border: 1px solid rgba(15,81,50,0.08);
        box-shadow: 0 4px 24px rgba(15,81,50,0.07);
    }

    .nav-left, .nav-right { display: flex; align-items: center; gap: 36px; }
    .nav-center { position: absolute; left: 50%; transform: translateX(-50%); }

    .navbar-logo { font-size: 22px; font-weight: 700; text-decoration: none; color: var(--green-dark); white-space: nowrap; letter-spacing: 0.5px; }

    .nav-item-link { text-decoration: none; color: #444; font-weight: 500; font-size: 13px; text-transform: uppercase; letter-spacing: 1.2px; transition: color 0.25s; position: relative; }
    .nav-item-link::after { content: ''; position: absolute; bottom: -3px; left: 0; width: 0; height: 1.5px; background: var(--green-dark); transition: width 0.25s; }
    .nav-item-link:hover { color: var(--green-dark); }
    .nav-item-link:hover::after { width: 100%; }

    @media(max-width:768px) {
        .nav-wrapper { flex-direction: column; gap: 16px; border-radius: 28px; padding: 22px 24px; }
        .nav-center { position: static; transform: none; order: -1; }
        .nav-left, .nav-right { flex-wrap: wrap; justify-content: center; gap: 18px; }
        .navbar-logo { font-size: 20px; }
    }

    /* ─── HERO ───────────────────────────────── */
    .hero {
        position: relative; width: 100%; height: 100vh;
        overflow: hidden; display: flex; align-items: center;
        justify-content: center; background: #2d4a3e;
    }
    .hero::after { content: ''; position: absolute; inset: 0; background: rgba(0,0,0,0.45); z-index: 1; pointer-events: none; }
    .hero-content { position: relative; z-index: 2; text-align: center; color: white; }
    .hero-eyebrow { font-size: 12px; letter-spacing: 3px; text-transform: uppercase; color: rgba(255,255,255,0.6); font-weight: 400; margin-bottom: 24px; }
    .hero h1 { font-size: 80px; font-weight: 800; line-height: 0.9; color: white; letter-spacing: -2px; margin-bottom: 24px; }
    .hero p { font-size: 16px; color: rgba(255,255,255,0.7); font-weight: 300; }

    .btn-premium {
        background: white; color: var(--green-dark); border: none;
        border-radius: 50px; padding: 15px 40px; font-size: 13px;
        font-weight: 700; letter-spacing: 1px; text-decoration: none;
        display: inline-flex; align-items: center; gap: 10px;
        transition: all 0.3s; font-family: 'Poppins', sans-serif;
    }
    .btn-premium:hover { background: var(--green-light); color: var(--green-dark); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,0.2); }

    .hero-stats { display: flex; align-items: center; gap: 32px; margin-top: 60px; justify-content: center; }
    .hero-stat .num { font-size: 28px; font-weight: 800; color: white; }
    .hero-stat .lbl { font-size: 11px; color: rgba(255,255,255,0.5); letter-spacing: 1.5px; text-transform: uppercase; }
    .hero-divider { width: 1px; height: 40px; background: rgba(255,255,255,0.2); }

    /* HERO SLIDER */
    .hero-slider { position: absolute; inset: 0; width: 100%; height: 100%; z-index: 0; }
    .hero-slider .slide { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: 0; transition: opacity 1s ease; }
    .hero-slider .slide.active { opacity: 1; }
    .slider-btn { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3); color: white; font-size: 28px; width: 52px; height: 52px; border-radius: 50%; cursor: pointer; z-index: 3; backdrop-filter: blur(4px); transition: background 0.2s; display: flex; align-items: center; justify-content: center; line-height: 1; }
    .slider-btn:hover { background: rgba(255,255,255,0.4); }
    .slider-btn.prev { left: 28px; }
    .slider-btn.next { right: 28px; }
    .slider-dots { position: absolute; bottom: 32px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 3; }
    .slider-dots span { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.4); cursor: pointer; transition: all 0.3s; border: 1px solid rgba(255,255,255,0.3); }
    .slider-dots span.active { background: white; width: 24px; border-radius: 4px; }

    /* SECTION */
    .section-label { font-size: 11px; letter-spacing: 3px; text-transform: uppercase; color: var(--green-muted); font-weight: 600; display: block; margin-bottom: 16px; }
    .section-title { font-size: 52px; font-weight: 800; color: var(--text-dark); line-height: 1.1; margin-bottom: 24px; }

    /* ─── ABOUT ──────────────────────────────── */
    .about { padding: 130px 0; background: white; }
    .about-intro { max-width: 700px; margin: 0 auto; color: var(--text-muted); font-size: 18px; line-height: 1.9; font-weight: 300; }
    .feature-card { background: var(--cream); padding: 36px 32px; border-radius: var(--radius-lg); height: 100%; border: 1px solid rgba(15,81,50,0.06); transition: border-color 0.3s, transform 0.3s; }
    .feature-card:hover { border-color: var(--green-border); transform: translateY(-4px); }
    .feature-icon-wrap { width: 64px; height: 64px; background: var(--green-light); border-radius: 18px; display: flex; justify-content: center; align-items: center; margin-bottom: 24px; }
    .feature-icon-wrap i { font-size: 28px; color: var(--green-dark); }
    .feature-card h3 { font-size: 20px; font-weight: 700; color: var(--green-dark); margin-bottom: 12px; }
    .feature-card p { color: var(--text-muted); line-height: 1.8; font-size: 14px; }

    .about-cta-block { background: linear-gradient(135deg, var(--green-dark) 0%, var(--green-mid) 100%); border-radius: var(--radius-lg); padding: 72px 64px; display: flex; align-items: center; justify-content: space-between; gap: 40px; position: relative; overflow: hidden; margin-top: 16px; }
    .about-cta-block::before { content: '☕'; position: absolute; font-size: 280px; opacity: 0.05; right: -40px; bottom: -60px; pointer-events: none; line-height: 1; }
    .about-cta-left { flex: 1; position: relative; z-index: 1; }
    .about-cta-eyebrow { font-size: 11px; letter-spacing: 3px; text-transform: uppercase; color: rgba(255,255,255,0.5); font-weight: 500; margin-bottom: 16px; display: block; }
    .about-cta-title { font-size: 40px; font-weight: 800; color: white; line-height: 1.1; margin-bottom: 16px; }
    .about-cta-desc { color: rgba(255,255,255,0.65); font-size: 15px; line-height: 1.8; font-weight: 300; max-width: 480px; }
    .about-cta-right { flex-shrink: 0; position: relative; z-index: 1; }
    .about-cta-stats { display: flex; flex-direction: column; gap: 24px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 24px; padding: 32px 40px; min-width: 220px; }
    .about-cta-stat { text-align: center; }
    .about-cta-stat .num { font-size: 36px; font-weight: 800; color: white; line-height: 1; }
    .about-cta-stat .lbl { font-size: 11px; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.45); margin-top: 6px; }
    .about-cta-stat-divider { height: 1px; background: rgba(255,255,255,0.1); }
    .btn-about-learn { background: white; color: var(--green-dark); border: none; border-radius: 50px; padding: 15px 36px; font-weight: 700; font-size: 13px; text-decoration: none; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; margin-top: 32px; }
    .btn-about-learn:hover { background: var(--green-light); color: var(--green-dark); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,0.2); }

    @media(max-width:900px) { .about-cta-block { flex-direction: column; padding: 48px 32px; } .about-cta-title { font-size: 30px; } .about-cta-stats { flex-direction: row; min-width: auto; width: 100%; justify-content: space-around; } }
    @media(max-width:500px) { .about-cta-stats { flex-direction: column; } .about-cta-stat-divider { display: none; } }

    /* ─── MENU ───────────────────────────────── */
    .menu-section { padding: 40px 0 0; background: var(--cream); }
    .card-product { border: 1px solid rgba(15,81,50,0.08); border-radius: var(--radius-lg); overflow: hidden; background: white; transition: all 0.3s; height: 100%; display: flex; flex-direction: column; cursor: pointer; }
    .card-product:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(15,81,50,0.1); border-color: var(--green-border); }
    .card-product-img-wrap { overflow: hidden; }
    .card-product img { width: 100%; height: 260px; object-fit: cover; transition: transform 0.5s; display: block; }
    .card-product:hover img { transform: scale(1.04); }
    .card-body-inner { padding: 24px; display: flex; flex-direction: column; flex: 1; }
    .card-body-inner h3 { font-size: 18px; font-weight: 700; color: var(--green-dark); margin-bottom: 6px; }
    .card-body-inner .desc { color: var(--text-muted); font-size: 13px; line-height: 1.7; margin-bottom: 0; }

    .size-toggle { display: flex; gap: 8px; margin: 14px 0; }
    .size-btn { flex: 1; border: 1.5px solid var(--green-border); border-radius: var(--radius-sm); background: white; color: var(--green-dark); font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; padding: 8px 6px; cursor: pointer; transition: all 0.2s; text-align: center; line-height: 1.3; }
    .size-btn .size-label { display: block; font-weight: 600; font-size: 13px; }
    .size-btn .size-price { display: block; font-size: 11px; color: var(--green-muted); margin-top: 2px; }
    .size-btn.active { background: var(--green-dark); border-color: var(--green-dark); color: white; box-shadow: 0 4px 12px rgba(15,81,50,0.25); }
    .size-btn.active .size-price { color: rgba(255,255,255,0.75); }
    .size-btn:hover:not(.active) { border-color: var(--green-mid); background: var(--green-light); }

    .btn-add-cart { background: var(--green-dark); color: white; border: none; border-radius: 50px; padding: 11px 18px; font-weight: 500; font-size: 13px; font-family: 'Poppins', sans-serif; transition: all 0.3s; cursor: pointer; flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 6px; }
    .btn-add-cart:hover { background: var(--green-mid); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(15,81,50,0.3); }
    .btn-order-now { background: transparent; color: var(--text-dark); border: 1.5px solid rgba(0,0,0,0.15); border-radius: 50px; padding: 11px 18px; font-weight: 500; font-size: 13px; font-family: 'Poppins', sans-serif; transition: all 0.3s; cursor: pointer; flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 6px; text-decoration: none; }
    .btn-order-now:hover { background: var(--text-dark); color: white; border-color: var(--text-dark); }

    .product-modal { position: fixed; inset: 0; background: rgba(0,0,0,0.45); display: none; justify-content: center; align-items: center; z-index: 999999; padding: 24px; backdrop-filter: blur(4px); }
    .product-modal.active { display: flex; }
    .product-modal-content { background: white; width: 100%; max-width: 860px; border-radius: var(--radius-lg); padding: 36px; position: relative; box-shadow: 0 32px 80px rgba(0,0,0,0.18); }
    .close-modal { position: absolute; top: 20px; right: 24px; border: 1px solid rgba(0,0,0,0.08); background: var(--cream); width: 40px; height: 40px; border-radius: 50%; font-size: 20px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-dark); transition: background 0.2s; line-height: 1; }
    .close-modal:hover { background: #e5e5e5; }
    #modalName { font-size: 26px; font-weight: 700; color: var(--green-dark); margin-bottom: 10px; padding-right: 40px; }
    #modalDescription { color: var(--text-muted); font-size: 14px; line-height: 1.9; }
    .modal-size-toggle { display: flex; gap: 10px; margin: 20px 0; }

    .menu-banner { text-align: center; margin-top: 80px; }
    .btn-goto-order { background: var(--green-dark); color: white; border: none; border-radius: 50px; padding: 16px 48px; font-size: 14px; font-weight: 600; letter-spacing: 0.5px; text-decoration: none; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; }
    .btn-goto-order:hover { background: var(--green-mid); color: white; transform: translateY(-2px); box-shadow: 0 8px 28px rgba(15,81,50,0.3); }

    /* ─── CART ───────────────────────────────── */
    .cart-btn-wrap { position: fixed; right: 28px; bottom: 28px; z-index: 9999; }
    .cart-button { width: 64px; height: 64px; border: none; border-radius: 50%; background: var(--green-dark); color: white; font-size: 24px; box-shadow: 0 8px 28px rgba(15,81,50,0.35); transition: all 0.3s; display: flex; align-items: center; justify-content: center; cursor: pointer; position: relative; }
    .cart-button:hover { background: var(--green-mid); transform: scale(1.06); }
    .cart-badge { position: absolute; top: -6px; right: -6px; background: #e63946; color: white; font-size: 11px; font-weight: 700; min-width: 22px; height: 22px; border-radius: 50px; display: none; align-items: center; justify-content: center; font-family: 'Poppins', sans-serif; padding: 0 6px; border: 2px solid white; line-height: 1; }
    .cart-badge.show { display: flex; }

    .cart-sidebar { position: fixed; top: 0; right: -460px; width: 420px; height: 100%; background: white; z-index: 99999; transition: right 0.4s cubic-bezier(0.4,0,0.2,1); padding: 36px 28px; overflow-y: auto; box-shadow: -8px 0 48px rgba(0,0,0,0.12); }
    .cart-sidebar.active { right: 0; }
    .cart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
    .cart-header h2 { font-weight: 700; font-size: 26px; color: var(--green-dark); }
    .close-cart { background: var(--cream); border: 1px solid rgba(0,0,0,0.08); font-size: 22px; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-dark); line-height: 1; transition: background 0.2s; }
    .close-cart:hover { background: #e5e5e5; }

    .cart-item { background: var(--cream); padding: 16px 18px; border-radius: var(--radius-md); margin-bottom: 12px; border: 1px solid rgba(15,81,50,0.07); display: flex; align-items: center; gap: 12px; }
    .cart-item-info { flex: 1; }
    .cart-item-info h5 { color: var(--green-dark); font-weight: 600; font-size: 14px; margin-bottom: 2px; }
    .cart-item-info p { color: var(--text-muted); font-size: 12px; margin-bottom: 0; }
    .cart-item-price { font-weight: 700; color: var(--green-dark); font-size: 13px; white-space: nowrap; }
    .qty-control { display: flex; align-items: center; gap: 8px; margin-top: 8px; }
    .qty-btn { width: 26px; height: 26px; border-radius: 50%; border: 1.5px solid var(--green-border); background: white; color: var(--green-dark); font-size: 16px; font-weight: 600; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; line-height: 1; flex-shrink: 0; }
    .qty-btn:hover { background: var(--green-dark); color: white; border-color: var(--green-dark); }
    .qty-num { font-size: 14px; font-weight: 700; color: var(--green-dark); min-width: 20px; text-align: center; }
    .empty-cart { text-align: center; padding: 48px 0; color: var(--text-muted); }
    .empty-cart i { font-size: 48px; color: var(--green-border); display: block; margin-bottom: 16px; }
    .empty-cart p { font-size: 14px; }

    .total-box { background: var(--green-dark); color: white; padding: 24px; border-radius: var(--radius-md); margin-top: 28px; }
    .total-box h4 { font-size: 20px; font-weight: 700; margin-bottom: 0; }

    #namaLengkap { width: 100%; border-radius: 50px; padding: 12px 18px; border: 1px solid rgba(255,255,255,0.25); margin-top: 16px; font-family: 'Poppins', sans-serif; font-size: 14px; color: var(--green-dark); background: white; }
    #namaLengkap::placeholder { color: #aaa; }
    #namaLengkap:focus { outline: none; }

    /* DELIVERY TOGGLE */
    .delivery-section-label { font-size: 11px; color: rgba(255,255,255,0.55); letter-spacing: 1.5px; text-transform: uppercase; font-weight: 600; margin-top: 16px; margin-bottom: 10px; display: block; }
    .delivery-toggle { display: flex; gap: 8px; margin-bottom: 12px; }
    .delivery-btn { flex: 1; border: 1.5px solid rgba(255,255,255,0.25); border-radius: var(--radius-sm); background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.7); font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 500; padding: 12px 8px; cursor: pointer; transition: all 0.2s; text-align: center; line-height: 1.4; }
    .delivery-btn .d-icon { font-size: 20px; display: block; margin-bottom: 4px; }
    .delivery-btn .d-label { display: block; font-weight: 600; font-size: 13px; }
    .delivery-btn .d-sub { display: block; font-size: 11px; opacity: 0.7; margin-top: 2px; }
    .delivery-btn:hover:not(.active) { background: rgba(255,255,255,0.18); border-color: rgba(255,255,255,0.4); color: white; }
    .delivery-btn.active { background: white; border-color: white; color: var(--green-dark); box-shadow: 0 4px 16px rgba(0,0,0,0.15); }
    .delivery-btn.active .d-sub { color: var(--green-muted); opacity: 1; }

    /* AREA PENGIRIMAN */
    .delivery-area-box { border-radius: 14px; overflow: hidden; border: 1px solid rgba(255,255,255,0.15); margin-bottom: 12px; }
    .delivery-area-header { background: rgba(255,255,255,0.12); padding: 10px 14px; display: flex; align-items: center; gap: 8px; border-bottom: 1px solid rgba(255,255,255,0.1); }
    .delivery-area-header span { font-size: 11px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: rgba(255,255,255,0.9); }
    .delivery-area-chips { background: rgba(255,255,255,0.07); padding: 10px 14px; display: flex; flex-wrap: wrap; gap: 6px; }
    .area-chip { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2); border-radius: 50px; padding: 3px 12px; font-size: 11px; color: white; font-weight: 500; }
    .delivery-area-warning { background: rgba(255,209,102,0.12); border-top: 1px solid rgba(255,209,102,0.25); padding: 10px 14px; display: flex; align-items: flex-start; gap: 8px; }
    .delivery-area-warning span { font-size: 11px; color: #ffd166; line-height: 1.6; font-weight: 500; }

    .alamat-label { font-size: 11px; color: rgba(255,255,255,0.55); letter-spacing: 1px; text-transform: uppercase; font-weight: 500; margin-top: 14px; display: block; }

    #alamat { width: 100%; border-radius: var(--radius-md); padding: 14px 18px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.12); color: white; font-family: 'Poppins', sans-serif; font-size: 14px; margin-top: 12px; min-height: 90px; resize: none; transition: all 0.3s; }
    #alamat::placeholder { color: rgba(255,255,255,0.5); }
    #alamat:focus { outline: none; border-color: rgba(255,255,255,0.45); }

    .btn-checkout { background: white; color: var(--green-dark); border: none; border-radius: 50px; padding: 14px 24px; font-weight: 700; font-size: 14px; font-family: 'Poppins', sans-serif; width: 100%; margin-top: 16px; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
    .btn-checkout:hover { background: var(--green-light); }

    .btn-map { background: rgba(255,255,255,0.15); color: white; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 50px; padding: 11px 18px; font-weight: 600; font-size: 13px; font-family: 'Poppins', sans-serif; width: 100%; margin-top: 10px; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
    .btn-map:hover { background: rgba(255,255,255,0.25); border-color: rgba(255,255,255,0.5); }

    @media(max-width:768px) { .cart-sidebar { width: 100%; right: -100%; } }

    /* ─── TESTIMONIAL ────────────────────────── */
    .testi-section { padding: 60px 0 90px; background: white; }
    .testi-card { background: var(--cream); border: 1px solid rgba(15,81,50,0.07); border-radius: var(--radius-lg); padding: 36px 32px; height: 100%; transition: border-color 0.3s, transform 0.3s; }
    .testi-card:hover { border-color: var(--green-border); transform: translateY(-4px); }
    .testi-stars { color: #f5a623; font-size: 14px; margin-bottom: 16px; }
    .testi-quote-icon { font-size: 48px; color: var(--green-light); font-family: Georgia, serif; line-height: 1; margin-bottom: 12px; }
    .testi-text { font-size: 14px; color: var(--text-muted); line-height: 1.9; font-style: italic; margin-bottom: 30px; }
    .testi-author { display: flex; align-items: center; gap: 12px; }
    .testi-avatar { width: 44px; height: 44px; background: var(--green-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 17px; font-weight: 700; color: var(--green-dark); flex-shrink: 0; }
    .testi-name { font-size: 14px; font-weight: 600; color: var(--text-dark); }
    .testi-role { font-size: 12px; color: var(--text-muted); }

    /* ─── CTA ────────────────────────────────── */
    .cta-section { background: var(--green-dark); padding: 72px 20px; text-align: center; position: relative; overflow: hidden; }
    .cta-section::before { content: '☕'; position: absolute; font-size: 320px; opacity: 0.04; top: 50%; left: 50%; transform: translate(-50%, -50%); pointer-events: none; }
    .cta-section h2 { font-size: 56px; font-weight: 800; color: white; line-height: 1.1; margin-bottom: 20px; }
    .cta-section p { color: rgba(255,255,255,0.6); font-size: 16px; font-weight: 300; margin-bottom: 40px; max-width: 480px; margin-left: auto; margin-right: auto; }
    .btn-cta-white { background: white; color: var(--green-dark); border: none; border-radius: 50px; padding: 16px 44px; font-size: 14px; font-weight: 700; text-decoration: none; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; }
    .btn-cta-white:hover { background: var(--green-light); color: var(--green-dark); transform: translateY(-3px); box-shadow: 0 12px 32px rgba(0,0,0,0.2); }
    .btn-cta-ghost { background: transparent; color: rgba(255,255,255,0.8); border: 1.5px solid rgba(255,255,255,0.3); border-radius: 50px; padding: 16px 44px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; }
    .btn-cta-ghost:hover { background: rgba(255,255,255,0.1); color: white; border-color: rgba(255,255,255,0.6); }
    @media(max-width:768px) { .cta-section h2 { font-size: 36px; } }

    /* ─── CONTACT ────────────────────────────── */
    .contact { background: var(--green-dark); color: white; padding: 0 20px; text-align: center; }
    .contact h1 { font-size: 56px; font-weight: 700; margin-bottom: 16px; }
    .contact-subtitle { color: rgba(255,255,255,0.55); font-size: 15px; margin-bottom: 60px; font-weight: 300; }
    .contact-card { background: rgba(255,255,255,0.07); padding: 40px 32px; border-radius: var(--radius-lg); height: 100%; border: 1px solid rgba(255,255,255,0.1); text-align: left; transition: background 0.3s; }
    .contact-card:hover { background: rgba(255,255,255,0.1); }
    .contact-card i.main-icon { font-size: 36px; color: rgba(255,255,255,0.8); }
    .contact-card h3 { font-size: 20px; font-weight: 700; margin-top: 20px; margin-bottom: 16px; }
    .contact-card p { line-height: 1.9; color: rgba(255,255,255,0.7); font-size: 14px; }
    .contact-row-item { display: flex; align-items: center; gap: 10px; color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 10px; }
    .contact-row-item i { font-size: 16px; color: rgba(255,255,255,0.5); width: 18px; }
    @media(max-width:768px) { .contact h1 { font-size: 38px; } }

    /* ─── FOOTER ─────────────────────────────── */
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
    .sdj-badge { font-size: 11px; background: #e8f5ee; color: #0f5132; padding: 4px 12px; border-radius: 50px; border: 1px solid #b6dfc8; }

    @media(max-width:768px) { .sdj-grid { grid-template-columns: 1fr 1fr; gap: 28px; } .sdj-strip { gap: 20px; } .sdj-bottom { justify-content: center; text-align: center; } }
    @media(max-width:480px) { .sdj-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

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
                <a href="/contact" class="nav-item-link">Kontak</a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="home">
    <div class="hero-content">
        <p class="hero-eyebrow">Bangsri, Jepara — Est. 2020</p>
        <h1>SEMOGA<br>DJAYA</h1>
        <p>Premium Coffee Experience ☕</p>
        <a href="#menu" class="btn btn-premium mt-5">Jelajahi Menu</a>
        <div class="hero-stats">
            <div class="hero-stat"><div class="num">20+</div><div class="lbl">Menu Pilihan</div></div>
            <div class="hero-divider"></div>
            <div class="hero-stat"><div class="num">1K+</div><div class="lbl">Pelanggan</div></div>
            <div class="hero-divider"></div>
            <div class="hero-stat"><div class="num">4.9</div><div class="lbl">Rating</div></div>
            <div class="hero-divider"></div>
            <div class="hero-stat"><div class="num">7</div><div class="lbl">Hari Buka</div></div>
        </div>
    </div>
    <div class="hero-slider">
        <div class="slide active" style="background-image: url('{{ asset('images/bg-coffee.jpeg') }}')"></div>
        <div class="slide" style="background-image: url('{{ asset('images/bg-coffee2.jpeg') }}')"></div>
        <div class="slide" style="background-image: url('{{ asset('images/bg-coffee3.jpeg') }}')"></div>
        <div class="slide" style="background-image: url('{{ asset('images/bg-coffee4.jpeg') }}')"></div>
        <button class="slider-btn prev" onclick="changeSlide(-1)">&#8249;</button>
        <button class="slider-btn next" onclick="changeSlide(1)">&#8250;</button>
        <div class="slider-dots" id="sliderDots"></div>
    </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Tentang Kami</span>
            <h1 class="section-title" style="color:var(--green-dark)">Kenali Kami<br>Lebih Dekat</h1>
            <p class="about-intro">Semoga Djaya Coffee hadir sebagai tempat nyaman untuk menikmati kopi, berkumpul, berbagi cerita, dan menciptakan suasana hangat bersama.</p>
        </div>
        <div class="row g-4 mb-5">
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
        </div>
        <div class="about-cta-block">
            <div class="about-cta-left">
                <span class="about-cta-eyebrow">Est. 2020 · Bangsri, Jepara</span>
                <h2 class="about-cta-title">Lebih dari Sekadar<br>Secangkir Kopi</h2>
                <p class="about-cta-desc">Kami hadir dengan misi sederhana — menciptakan ruang yang hangat, inklusif, dan penuh semangat bagi siapa saja yang ingin bersantai, berkreasi, atau sekadar menikmati hari.</p>
                <a href="/about" class="btn-about-learn">
                    <i class="bi bi-arrow-right-circle-fill" style="color:var(--green-dark)"></i> Kenali Kami Lebih Lanjut
                </a>
            </div>
            <div class="about-cta-right">
                <div class="about-cta-stats">
                    <div class="about-cta-stat"><div class="num">4+</div><div class="lbl">Tahun Berdiri</div></div>
                    <div class="about-cta-stat-divider"></div>
                    <div class="about-cta-stat"><div class="num">1K+</div><div class="lbl">Pelanggan Puas</div></div>
                    <div class="about-cta-stat-divider"></div>
                    <div class="about-cta-stat"><div class="num">20+</div><div class="lbl">Menu Tersedia</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MENU -->
<section class="menu-section" id="menu">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Pilihan Kami</span>
            <h1 class="section-title" style="color:var(--green-dark)">Menu Kami</h1>
            <p style="color:var(--text-muted); font-size:15px; margin-top:-8px;">Menu unggulan kami — pilih, pesan, nikmati.</p>
        </div>

        <div class="row">
            @foreach($products->take(6) as $product)
            <div class="col-md-4 mb-4">
                <div class="card-product h-100"
                    onclick="openProductModal(
                        '{{ $product->name }}',
                        '{{ $product->description }}',
                        '{{ asset('products/' . $product->image) }}',
                        '{{ $product->price_regular }}',
                        '{{ $product->price_large }}',
                        '{{ $product->id }}'
                    )">
                    <div class="card-product-img-wrap">
                        <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body-inner">
                        <h3>{{ $product->name }}</h3>
                        <p class="desc">{{ $product->description }}</p>
                        <div class="size-toggle" onclick="event.stopPropagation()" id="sizeToggle{{ $product->id }}">
                            <button class="size-btn active" onclick="selectSize('{{ $product->id }}', 'Regular', {{ $product->price_regular }}, this)">
                                <span class="size-label">Regular</span>
                                <span class="size-price">Rp {{ number_format($product->price_regular, 0, ',', '.') }}</span>
                            </button>
                            <button class="size-btn" onclick="selectSize('{{ $product->id }}', 'Large', {{ $product->price_large }}, this)">
                                <span class="size-label">Large</span>
                                <span class="size-price">Rp {{ number_format($product->price_large, 0, ',', '.') }}</span>
                            </button>
                        </div>
                        <div class="d-flex gap-2 mt-auto" onclick="event.stopPropagation()">
                            <button class="btn-add-cart" onclick="addToCart('{{ $product->name }}', '{{ $product->id }}')">
                                <i class="bi bi-cart-plus"></i> Keranjang
                            </button>
                            <a href="/order" class="btn-order-now">Order</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="menu-banner">
            <p style="color:var(--text-muted); font-size:15px; margin-bottom:20px;">Mau lihat semua menu & pesan langsung?</p>
            <a href="/order" class="btn-goto-order">
                <i class="bi bi-bag-fill"></i> Lihat Semua Menu & Order
            </a>
        </div>
    </div>
</section>

<!-- TESTIMONIAL -->
<section class="testi-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Kata Mereka</span>
            <h1 class="section-title" style="color:var(--green-dark)">Yang Pelanggan<br>Rasakan</h1>
        </div>

        @if($testimonials->count() > 0)
        <div class="row g-4">
            @foreach($testimonials as $testi)
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">
                        @for($i = 1; $i <= 5; $i++) {{ $i <= $testi->rating ? '★' : '☆' }} @endfor
                    </div>
                    <div class="testi-quote-icon">"</div>
                    <p class="testi-text">{{ $testi->content }}</p>
                    <div class="testi-author">
                        <div class="testi-avatar">{{ strtoupper(substr($testi->name, 0, 1)) }}</div>
                        <div>
                            <div class="testi-name">{{ $testi->name }}</div>
                            <div class="testi-role">{{ $testi->role }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4">
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <div class="testi-quote-icon">"</div>
                    <p class="testi-text">Kopinya enak banget, suasananya cozy dan bikin betah lama-lama. Jadi tempat favorit buat ngerjain tugas!</p>
                    <div class="testi-author">
                        <div class="testi-avatar">A</div>
                        <div><div class="testi-name">Andi Kurniawan</div><div class="testi-role">Pelanggan Setia</div></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <div class="testi-quote-icon">"</div>
                    <p class="testi-text">Harganya terjangkau tapi kualitasnya ga kalah sama coffee shop besar. Pelayanannya juga ramah banget!</p>
                    <div class="testi-author">
                        <div class="testi-avatar">S</div>
                        <div><div class="testi-name">Siti Rahayu</div><div class="testi-role">Pelanggan Setia</div></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <div class="testi-quote-icon">"</div>
                    <p class="testi-text">Paling suka sama menu kopi susu-nya, ngangenin banget. Tempatnya juga instagramable dan nyaman buat nongkrong.</p>
                    <div class="testi-author">
                        <div class="testi-avatar">R</div>
                        <div><div class="testi-name">Rizky Pratama</div><div class="testi-role">Pelanggan Setia</div></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container" style="position:relative; z-index:1;">
        <span class="section-label" style="color:rgba(255,255,255,0.4);">Yuk Ke Sini</span>
        <h2>Siap untuk<br>Ngopi Bareng?</h2>
        <p>Kunjungi kami atau pesan sekarang lewat halaman order. Buka setiap hari dari pagi sampai malam.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="/order" class="btn-cta-white"><i class="bi bi-bag-fill"></i> Order Sekarang</a>
            <a href="https://wa.me/6282135443492" target="_blank" class="btn-cta-ghost"><i class="bi bi-whatsapp"></i> Hubungi Kami</a>
        </div>
    </div>
</section>

<!-- CONTACT -->
<section class="contact" id="contact">
    <div class="container">
        <span class="section-label" style="color:rgba(255,255,255,0.45);">Temukan Kami</span>
        <h1>Contact Us</h1>
        <p class="contact-subtitle">Kami siap melayani kamu setiap hari</p>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="bi bi-geo-alt-fill main-icon"></i>
                    <h3>Alamat</h3>
                    <p>FQH8+WP6, Jl. Wijaya Kusuma, Krsak, Bangsri, Kec. Bangsri, Kabupaten Jepara, Jawa Tengah 59453</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="bi bi-telephone-fill main-icon"></i>
                    <h3>Contact</h3>
                    <div class="mt-2">
                        <div class="contact-row-item"><i class="bi bi-whatsapp"></i><span>082135443492</span></div>
                        <div class="contact-row-item"><i class="bi bi-instagram"></i><span>@warungkopi.semogadjaya</span></div>
                        <div class="contact-row-item"><i class="bi bi-envelope-fill"></i><span>putradwi091290@gmail.com</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="bi bi-clock-fill main-icon"></i>
                    <h3>Jam Operasional</h3>
                    <div class="mt-2">
                        <div class="contact-row-item"><span>Senin – Minggu</span></div>
                        <div class="contact-row-item" style="color:white; font-size:22px; font-weight:700;">09.00 – 22.00</div>
                        <div class="contact-row-item" style="margin-top:8px;"><span>Buka setiap hari tanpa libur</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="sdj-footer">
    <div class="sdj-container">
        <div class="sdj-grid">
            <div>
                <div class="sdj-logo">SEMOGA<br>DJAYA</div>
                <p class="sdj-tagline">Tempat nyaman untuk menikmati kopi, berbagi cerita, dan menciptakan suasana hangat bersama.</p>
                <div class="sdj-quote">"Hidup terlalu singkat untuk kopi yang biasa-biasa saja."</div>
                <div class="sdj-social-row">
                    <a href="https://instagram.com/warungkopi.semogadjaya" class="sdj-social-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="sdj-social-btn"><i class="bi bi-tiktok"></i></a>
                    <a href="https://wa.me/6282135443492" class="sdj-social-btn"><i class="bi bi-whatsapp"></i></a>
                </div>
                <div class="sdj-social-handle">Instagram: <a href="https://instagram.com/warungkopi.semogadjaya">@warungkopi.semogadjaya</a></div>
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
                <div class="sdj-contact-row"><div class="sdj-contact-icon"><i class="bi bi-geo-alt-fill"></i></div><div class="sdj-contact-text">Bangsri, Jepara,<br>Jawa Tengah</div></div>
                <div class="sdj-contact-row"><div class="sdj-contact-icon"><i class="bi bi-whatsapp"></i></div><div class="sdj-contact-text">082135443492</div></div>
                <div class="sdj-contact-row"><div class="sdj-contact-icon"><i class="bi bi-envelope-fill"></i></div><div class="sdj-contact-text">putradwi091290@gmail.com</div></div>
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
            <span class="sdj-badge">Jepara, Jawa Tengah</span>
        </div>
    </div>
</footer>

<!-- PRODUCT MODAL -->
<div class="product-modal" id="productModal">
    <div class="product-modal-content">
        <button class="close-modal" onclick="closeModal()">×</button>
        <div class="row align-items-center g-4">
            <div class="col-md-5">
                <img id="modalImage" src="" alt="" style="width:100%;height:320px;object-fit:cover;border-radius:var(--radius-md);display:block;">
            </div>
            <div class="col-md-7">
                <h2 id="modalName"></h2>
                <p id="modalDescription"></p>
                <div class="modal-size-toggle" id="modalSizeToggle"></div>
                <div class="d-flex gap-3 mt-3">
                    <button class="btn-add-cart" onclick="modalAddToCart()">
                        <i class="bi bi-cart-plus"></i> Keranjang
                    </button>
                    <a href="/order" class="btn-order-now">Order di Halaman Order</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CART BUTTON -->
<div class="cart-btn-wrap">
    <button class="cart-button" onclick="openCart()">
        <i class="bi bi-cart3"></i>
        <span class="cart-badge" id="cartBadge"></span>
    </button>
</div>

<!-- CART SIDEBAR -->
<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h2>Keranjang</h2>
        <button class="close-cart" onclick="closeCart()">×</button>
    </div>
    <div id="cartItems"></div>

    <div class="total-box">
        <h4 id="totalPrice">Total : Rp 0</h4>

        <input type="text" id="namaLengkap" placeholder="Nama lengkap pemesan..." autocomplete="off">

        <span class="delivery-section-label">Pilih Metode Pengiriman</span>

        <div class="delivery-toggle">
            <button class="delivery-btn active" id="btnAntar" onclick="selectDelivery('antar')">
                <span class="d-icon">🛵</span>
                <span class="d-label">Diantar</span>
                <span class="d-sub">via Grab</span>
            </button>
            <button class="delivery-btn" id="btnJemput" onclick="selectDelivery('jemput')">
                <span class="d-icon">🏪</span>
                <span class="d-label">Jemput</span>
                <span class="d-sub">ke Store</span>
            </button>
        </div>

        <input type="hidden" id="deliveryOption" value="antar">

        <div id="deliveryAreaInfo" class="delivery-area-box">
            <div class="delivery-area-header">
                <span style="font-size:15px;">📍</span>
                <span>Area Pengiriman</span>
            </div>
            <div class="delivery-area-chips">
                <span class="area-chip">Bangsri</span>
                <span class="area-chip">Mlonggo</span>
                <span class="area-chip">Kembang</span>
                <span class="area-chip">Pakis Aji</span>
                <span class="area-chip">& sekitarnya</span>
            </div>
            <div class="delivery-area-warning">
                <span style="font-size:14px; flex-shrink:0;">⚠️</span>
                <span>Jika lokasi berada di luar jangkauan, pesanan mungkin tidak dapat diantar.</span>
            </div>
        </div>

        <button type="button" class="btn-map" id="btnOpenMap" onclick="openMapModal()">
            <i class="bi bi-geo-alt-fill"></i> Pilih Lokasi di Map
        </button>

        <span class="alamat-label" id="alamatLabel">📍 Lokasi Pengiriman</span>
        <textarea id="alamat" placeholder="Alamat akan otomatis terisi setelah pilih di map..." readonly></textarea>

        <input type="hidden" id="latitude">
        <input type="hidden" id="longitude">

        <button class="btn-checkout" onclick="checkoutWhatsApp()">
            <i class="bi bi-whatsapp"></i> Order Sekarang
        </button>
    </div>
</div>

<!-- MAP MODAL -->
<div class="modal fade" id="mapModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Pilih Lokasi Pengiriman</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="map" style="height:450px; border-radius:12px;"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

/* ═══ CART ═══ */
let selectedSizes = {};
let cart = [];
const CART_KEY = 'sdj_cart';

function saveCart() { localStorage.setItem(CART_KEY, JSON.stringify(cart)); }
function loadCart() { try { cart = JSON.parse(localStorage.getItem(CART_KEY)) || []; } catch(e) { cart = []; } }

function selectSize(id, size, price, btn) {
    selectedSizes[id] = { size, price };
    document.getElementById('sizeToggle' + id).querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

function addToCart(name, id) {
    let wrap   = document.getElementById('sizeToggle' + id);
    let active = wrap ? wrap.querySelector('.size-btn.active') : null;
    let size, price;
    if (active) {
        size  = active.querySelector('.size-label').textContent.trim();
        price = parseInt(active.querySelector('.size-price').textContent.replace(/\D/g, ''));
    } else if (selectedSizes[id]) {
        size = selectedSizes[id].size; price = selectedSizes[id].price;
    } else {
        size = 'Regular';
        let first = wrap ? wrap.querySelector('.size-btn') : null;
        price = first ? parseInt(first.querySelector('.size-price').textContent.replace(/\D/g, '')) : 0;
    }
    let existing = cart.find(i => i.name === name && i.size === size);
    if (existing) { existing.qty++; } else { cart.push({ name, size, price, qty: 1 }); }
    saveCart(); renderCart(); openCart();
}

function changeQty(index, delta) {
    cart[index].qty += delta;
    if (cart[index].qty <= 0) cart.splice(index, 1);
    saveCart(); renderCart();
}

function renderCart() {
    let cartItems = document.getElementById('cartItems');
    let total = 0;
    cartItems.innerHTML = '';
    if (cart.length === 0) {
        cartItems.innerHTML = `<div class="empty-cart"><i class="bi bi-cart-x"></i><p>Keranjang masih kosong.<br>Yuk tambahkan menu!</p></div>`;
    } else {
        cart.forEach((item, index) => {
            let subtotal = item.price * item.qty;
            total += subtotal;
            cartItems.innerHTML += `
                <div class="cart-item">
                    <div class="cart-item-info">
                        <h5>${item.name}</h5>
                        <p>Size : ${item.size} &nbsp;·&nbsp; Rp ${item.price.toLocaleString('id-ID')}</p>
                        <div class="qty-control">
                            <button class="qty-btn" onclick="changeQty(${index}, -1)">−</button>
                            <span class="qty-num">${item.qty}</span>
                            <button class="qty-btn" onclick="changeQty(${index}, 1)">+</button>
                        </div>
                    </div>
                    <div class="cart-item-price">Rp ${subtotal.toLocaleString('id-ID')}</div>
                </div>`;
        });
    }
    document.getElementById('totalPrice').innerHTML = 'Total : Rp ' + total.toLocaleString('id-ID');
    let totalQty = cart.reduce((s, i) => s + i.qty, 0);
    let badge = document.getElementById('cartBadge');
    if (totalQty > 0) { badge.textContent = totalQty > 99 ? '99+' : totalQty; badge.classList.add('show'); }
    else { badge.classList.remove('show'); }
}

function openCart()  { document.getElementById('cartSidebar').classList.add('active'); }
function closeCart() { document.getElementById('cartSidebar').classList.remove('active'); }

/* ═══ DELIVERY TOGGLE ═══ */
function selectDelivery(type) {
    document.getElementById('deliveryOption').value = type;
    document.getElementById('btnAntar').classList.toggle('active', type === 'antar');
    document.getElementById('btnJemput').classList.toggle('active', type === 'jemput');
    let show = type === 'antar';
    document.getElementById('deliveryAreaInfo').style.display = show ? 'block' : 'none';
    document.getElementById('btnOpenMap').style.display       = show ? 'flex'  : 'none';
    document.getElementById('alamatLabel').style.display      = show ? 'block' : 'none';
    document.getElementById('alamat').style.display           = show ? 'block' : 'none';
}

/* ═══ CHECKOUT ═══ */
async function checkoutWhatsApp() {
    if (cart.length < 1) { alert('Keranjang masih kosong'); return; }

    let lat      = document.getElementById('latitude').value;
    let lng      = document.getElementById('longitude').value;
    let nama     = document.getElementById('namaLengkap').value.trim();
    let delivery = document.getElementById('deliveryOption').value;
    let alamat   = document.getElementById('alamat').value.trim();

    if (!nama) { alert('Mohon isi nama lengkap pemesan terlebih dahulu.'); document.getElementById('namaLengkap').focus(); return; }
    if (delivery === 'antar' && !alamat) { alert('Mohon pilih lokasi pengiriman di map terlebih dahulu.'); return; }

    let total = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

    let itemsText = cart.map((item, i) =>
        (i+1) + '. ' + item.name + ' - ' + item.size + ' x' + item.qty + ' - Rp ' + (item.price * item.qty).toLocaleString('id-ID')
    ).join('\n');

    let payload = {
        customer_name : nama,
        items         : itemsText,
        total         : total,
        delivery      : delivery,
        address       : delivery === 'antar' ? alamat : 'Jemput ke Store',
    };

    let btn = document.querySelector('.btn-checkout');
    let originalText = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Menyimpan...';
    btn.disabled  = true;

    try {
        let response = await fetch('/admin/order/store-from-website', {
            method  : 'POST',
            headers : {
                'Content-Type' : 'application/json',
                'Accept'       : 'application/json',
                'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body : JSON.stringify(payload),
        });
        let data = await response.json();
        if (!data.success) throw new Error(data.message || 'Gagal menyimpan order');

        let message = 'Halo SEMOGA DJAYA COFFEE ☕%0A%0A👤 Nama : ' + nama + '%0A%0ASaya ingin memesan :%0A';
        cart.forEach((item, i) => {
            let sub = item.price * item.qty;
            message += (i+1) + '. ' + item.name + ' - ' + item.size + ' ×' + item.qty + ' - Rp ' + sub.toLocaleString('id-ID') + '%0A';
        });
        message += '%0A💰 Total : Rp ' + total.toLocaleString('id-ID');
        if (delivery === 'antar') {
            message += '%0A%0A📍 Alamat : ' + alamat;
            if (lat && lng) message += '%0A🗺️ Maps : https://www.google.com/maps?q=' + lat + ',' + lng;
        } else {
            message += '%0A%0A📍 Pengambilan : Jemput ke Store';
        }

        cart = []; saveCart(); renderCart();
        window.open('https://wa.me/6282135443492?text=' + message, '_blank');

    } catch (err) {
        alert('Gagal menyimpan order: ' + err.message);
    } finally {
        btn.innerHTML = originalText;
        btn.disabled  = false;
    }
}

/* ═══ MAP ═══ */
let map, marker;
function openMapModal() {
    new bootstrap.Modal(document.getElementById('mapModal')).show();
    setTimeout(() => {
        if (!map) {
            map = L.map('map').setView([-6.5199, 110.7662], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
            map.on('click', async function(e) {
                let lat = e.latlng.lat, lng = e.latlng.lng;
                if (map.distance([-6.5199, 110.7662], [lat, lng]) / 1000 > 5) {
                    alert('❌ Lokasi di luar area pengiriman (maks 5 km).'); return;
                }
                if (marker) map.removeLayer(marker);
                marker = L.marker([lat, lng]).addTo(map);
                document.getElementById('latitude').value  = lat;
                document.getElementById('longitude').value = lng;
                try {
                    let res  = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
                    let data = await res.json();
                    document.getElementById('alamat').value = data.display_name;
                } catch(err) { document.getElementById('alamat').value = lat + ', ' + lng; }
            });
        }
        map.invalidateSize();
    }, 300);
}

/* ═══ PRODUCT MODAL ═══ */
let selectedProduct = {}, modalSelectedSize = '', modalSelectedPrice = 0;

function openProductModal(name, description, image, regular, large, id) {
    document.getElementById('productModal').classList.add('active');
    document.getElementById('modalName').innerHTML        = name;
    document.getElementById('modalDescription').innerHTML = description;
    document.getElementById('modalImage').src             = image;
    modalSelectedSize  = 'Regular';
    modalSelectedPrice = parseInt(regular);
    document.getElementById('modalSizeToggle').innerHTML = `
        <button class="size-btn active" style="flex:1;" onclick="selectModalSize('Regular', ${regular}, this)">
            <span class="size-label">Regular</span>
            <span class="size-price">Rp ${parseInt(regular).toLocaleString('id-ID')}</span>
        </button>
        <button class="size-btn" style="flex:1;" onclick="selectModalSize('Large', ${large}, this)">
            <span class="size-label">Large</span>
            <span class="size-price">Rp ${parseInt(large).toLocaleString('id-ID')}</span>
        </button>`;
    selectedProduct = { name, id, image };
}

function selectModalSize(size, price, btn) {
    modalSelectedSize  = size;
    modalSelectedPrice = parseInt(price);
    document.getElementById('modalSizeToggle').querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

function closeModal() { document.getElementById('productModal').classList.remove('active'); }

function modalAddToCart() {
    let existing = cart.find(i => i.name === selectedProduct.name && i.size === modalSelectedSize);
    if (existing) { existing.qty++; } else { cart.push({ name: selectedProduct.name, size: modalSelectedSize, price: modalSelectedPrice, qty: 1 }); }
    saveCart(); renderCart(); closeModal(); openCart();
}

document.getElementById('productModal').addEventListener('click', function(e) { if (e.target === this) closeModal(); });

/* ═══ HERO SLIDER ═══ */
const slides = document.querySelectorAll('.hero-slider .slide');
const dotsContainer = document.getElementById('sliderDots');
let current = 0, autoPlay;

slides.forEach((_, i) => {
    const dot = document.createElement('span');
    if (i === 0) dot.classList.add('active');
    dot.addEventListener('click', () => goTo(i));
    dotsContainer.appendChild(dot);
});

function goTo(index) {
    slides[current].classList.remove('active');
    dotsContainer.children[current].classList.remove('active');
    current = (index + slides.length) % slides.length;
    slides[current].classList.add('active');
    dotsContainer.children[current].classList.add('active');
    resetAutoPlay();
}
function changeSlide(dir) { goTo(current + dir); }
function resetAutoPlay() { clearInterval(autoPlay); autoPlay = setInterval(() => goTo(current + 1), 4000); }
resetAutoPlay();

document.addEventListener('click', function(e) {

    const cartSidebar = document.getElementById('cartSidebar');
    const cartButton  = document.querySelector('.cart-button');

    if (
        cartSidebar.classList.contains('active') &&
        !cartSidebar.contains(e.target) &&
        !cartButton.contains(e.target)
    ) {
        closeCart();
    }

});

/* ═══ INIT ═══ */
loadCart();
renderCart();
selectDelivery('antar');

</script>
</body>
</html>