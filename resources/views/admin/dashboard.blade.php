<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard • SEMOGA DJAYA COFFEE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f4f4f4; min-height: 100vh; display: flex; }

        /* SIDEBAR */
        .sidebar { width: 270px; background: #0f5132; min-height: 100vh; padding: 40px 25px; position: fixed; left: 0; top: 0; overflow-y: auto; }
        .sidebar h1 { color: white; font-size: 26px; font-weight: 900; margin-bottom: 40px; line-height: 1.3; }
        .sidebar a { display: flex; align-items: center; gap: 12px; color: white; text-decoration: none; padding: 13px 18px; border-radius: 14px; margin-bottom: 8px; font-size: 15px; font-weight: 500; transition: 0.25s; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.15); }
        .sidebar .nav-section { color: rgba(255,255,255,0.4); font-size: 10px; letter-spacing: 2px; text-transform: uppercase; margin: 24px 0 10px 18px; }

        /* MAIN */
        .main { margin-left: 270px; width: calc(100% - 270px); padding: 40px 48px; }

        /* STATS */
        .stat-card { background: white; border-radius: 24px; padding: 28px 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .stat-card .num { font-size: 36px; font-weight: 800; color: #0f5132; }
        .stat-card .lbl { font-size: 13px; color: #888; margin-top: 4px; }
        .stat-card .icon-wrap { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; }

        /* SECTION TITLE */
        .section-title { font-size: 22px; font-weight: 800; color: #0f5132; margin-bottom: 20px; }

        /* TABLE */
        .table-card { background: white; border-radius: 24px; padding: 28px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden; }
        .table th { font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: #888; font-weight: 600; border-bottom: 2px solid #f0f0f0; padding: 12px 16px; }
        .table td { padding: 14px 16px; vertical-align: middle; font-size: 14px; border-bottom: 1px solid #f8f8f8; }
        .table tr:last-child td { border-bottom: none; }

        /* BADGE */
        .badge-pending  { background: #fff3cd; color: #856404; padding: 5px 14px; border-radius: 50px; font-size: 12px; font-weight: 600; }
        .badge-diterima { background: #d1e7dd; color: #0a3622; padding: 5px 14px; border-radius: 50px; font-size: 12px; font-weight: 600; }
        /* Kolom aksi */
.action-column {
    min-width: 180px;
    white-space: nowrap;
}

/* Container tombol */
.action-buttons {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: nowrap;
}


        /* BUTTONS */
        .btn-green  { background: #0f5132; color: white; border: none; border-radius: 10px; padding: 8px 18px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
        .btn-green:hover { background: #0b3d27; color: white; }
        .btn-red    { background: #fee2e2; color: #b91c1c; border: none; border-radius: 10px; padding: 8px 14px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
        .btn-red:hover { background: #fecaca; }
        .btn-yellow { background: #fef9c3; color: #854d0e; border: none; border-radius: 10px; padding: 8px 14px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
        .btn-yellow:hover { background: #fef08a; }
        .btn-outline-green { background: transparent; border: 1.5px solid #0f5132; color: #0f5132; border-radius: 10px; padding: 7px 16px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
        .btn-outline-green:hover { background: #0f5132; color: white; }
        .btn-order{
    padding: 6px 10px !important;
    font-size: 11px !important;
    border-radius: 6px;

    display: inline-flex;
    align-items: center;
    gap: 5px;

    width: auto;
}


        
        /* MODAL */
        .modal-content { border: none; border-radius: 24px; }
        .modal-header { border-bottom: 1px solid #f0f0f0; padding: 24px 28px; }
        .modal-footer { border-top: 1px solid #f0f0f0; padding: 20px 28px; }
        .modal-body   { padding: 28px; }
        .modal-title  { font-weight: 800; color: #0f5132; font-size: 20px; }
        .form-label   { font-weight: 600; font-size: 14px; color: #333; margin-bottom: 8px; }
        .form-control, .form-select { border-radius: 12px; border: 1.5px solid #e5e5e5; padding: 10px 16px; font-size: 14px; }
        .form-control:focus, .form-select:focus { border-color: #0f5132; box-shadow: none; }
        textarea.form-control { min-height: 90px; }

        /* PRODUCT IMAGE */
        .product-img { width: 52px; height: 52px; object-fit: cover; border-radius: 12px; }

        /* ALERT */
        .alert-success { border-radius: 16px; border: none; background: #d1e7dd; color: #0a3622; }

        /* TABS */
        .nav-tabs { border-bottom: 2px solid #f0f0f0; margin-bottom: 24px; }
        .nav-tabs .nav-link { border: none; color: #888; font-weight: 600; font-size: 14px; padding: 10px 20px; border-radius: 0; }
        .nav-tabs .nav-link.active { color: #0f5132; border-bottom: 2px solid #0f5132; background: transparent; }

        /* ORDER DETAIL */
        .order-detail-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
        .order-detail-row:last-child { border-bottom: none; }
        .order-item-line { background: #f8f9fa; border-radius: 10px; padding: 10px 14px; margin-bottom: 8px; font-size: 13px; }

        /* TESTI CARD */
        .testi-admin-card { background: #f8f9fa; border-radius: 16px; padding: 20px; border: 1px solid #e5e5e5; margin-bottom: 12px; }
        .testi-admin-card .stars { color: #f5a623; font-size: 13px; }
        .testi-admin-card .testi-name { font-weight: 700; color: #0f5132; font-size: 15px; }
        .testi-admin-card .testi-role { font-size: 12px; color: #888; }
        .testi-admin-card .testi-content { font-size: 13px; color: #555; margin-top: 8px; font-style: italic; line-height: 1.7; }

        /* CLICKABLE ROW */
        .order-row-clickable { cursor: pointer; transition: background 0.2s; }
        .order-row-clickable:hover { background: #f0fdf4 !important; }

        /* ITEM ROW IN MODAL */
        .item-row { background: #f8f8f8; border-radius: 14px; border: 1px solid #eee; padding: 16px; margin-bottom: 10px; }

        /* RESPONSIVE */
        @media(max-width: 991px) {
            .sidebar { display: none; }
            .main { margin-left: 0; width: 100%; padding: 20px; }
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h1>SEMOGA<br>DJAYA<br>COFFEE</h1>
    <div class="nav-section">Menu</div>
    <a href="/admin" class="active"><i class="bi bi-grid-fill"></i> Dashboard</a>
    <a href="/admin/products"><i class="bi bi-box-seam"></i> Produk</a>
    <a href="/admin/testimonials"><i class="bi bi-chat-quote-fill"></i> Testimoni</a>
    <div class="nav-section">Lainnya</div>
    <a href="/" target="_blank"><i class="bi bi-globe"></i> Lihat Website</a>
</div>

<!-- MAIN -->
<div class="main">

    @if(session('success'))
        <div class="alert alert-success mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- STATS -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <div class="num">{{ $products->count() }}</div>
                    <div class="lbl">Total Produk</div>
                </div>
                <div class="icon-wrap" style="background:#e8f5ee"><i class="bi bi-cup-hot-fill" style="color:#0f5132"></i></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <div class="num">{{ $totalPending }}</div>
                    <div class="lbl">Order Pending</div>
                </div>
                <div class="icon-wrap" style="background:#fff3cd"><i class="bi bi-clock-fill" style="color:#856404"></i></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <div class="num">{{ $totalDiterima }}</div>
                    <div class="lbl">Order Diterima</div>
                </div>
                <div class="icon-wrap" style="background:#d1e7dd"><i class="bi bi-check-circle-fill" style="color:#0a3622"></i></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <div class="num" style="font-size:22px">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    <div class="lbl">Total Pendapatan</div>
                </div>
                <div class="icon-wrap" style="background:#dcfce7"><i class="bi bi-cash-stack" style="color:#166534"></i></div>
            </div>
        </div>
    </div>

    <!-- TABS -->
    <ul class="nav nav-tabs" id="dashTab">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-order">
                <i class="bi bi-bag-fill me-1"></i> Order
                @if($totalPending > 0)
                    <span class="badge bg-danger ms-1" style="font-size:10px">{{ $totalPending }}</span>
                @endif
            </button>
        </li>
    </ul>

    <div class="tab-content">

        <!-- ══ TAB ORDER ══ -->
        <div class="tab-pane fade show active" id="tab-order">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="section-title mb-0">Daftar Order</div>
                <button class="btn-green" data-bs-toggle="modal" data-bs-target="#modalTambahOrder">
                    <i class="bi bi-plus-lg me-1"></i> Catat Order Baru
                </button>
            </div>
            <div class="d-flex gap-2 mb-3 flex-wrap">
                <button class="btn-outline-green order-filter active" data-filter="all">Semua ({{ $orders->count() }})</button>
                <button class="btn-outline-green order-filter" data-filter="pending">Pending ({{ $totalPending }})</button>
                <button class="btn-outline-green order-filter" data-filter="diterima">Diterima ({{ $totalDiterima }})</button>
            </div>
            <div class="table-card">
                @if($orders->count() > 0)
<div class="table-responsive">
<table class="table" id="orderTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Pemesan</th>
            <th>Item</th>
            <th>Total</th>
            <th>Pengiriman</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
    <tr class="order-row order-row-clickable"
        data-status="{{ $order->status }}"
        data-id="{{ $order->id }}"
        data-nama="{{ $order->customer_name }}"
        data-items="{{ htmlspecialchars($order->items, ENT_QUOTES) }}"
        data-total="{{ $order->total }}"
        data-delivery="{{ $order->delivery }}"
        data-address="{{ $order->address ?? '' }}"
        data-status-val="{{ $order->status }}"
        data-notes="{{ $order->notes ?? '' }}"
        data-tanggal="{{ $order->created_at->format('d M Y, H:i') }}"
        onclick="openOrderDetail(this)">
        <td class="text-muted" style="font-size:12px">#{{ $order->id }}</td>
        <td>
            <div style="font-weight:600">{{ $order->customer_name }}</div>
            @if($order->notes)
                <div style="font-size:12px; color:#888">{{ $order->notes }}</div>
            @endif
        </td>
        <td>
            <div style="max-width:220px; font-size:13px; color:#555">
                @php $itemsDecoded = json_decode($order->items, true); @endphp
                @if(is_array($itemsDecoded))
                    @foreach($itemsDecoded as $item)
                        <div>{{ $item['name'] ?? '-' }}
                            <span class="text-muted">({{ $item['size'] ?? '' }} x{{ $item['qty'] ?? 1 }})</span>
                        </div>
                    @endforeach
                @else
                    {{ Str::limit($order->items, 60) }}
                @endif
            </div>
        </td>
        <td style="font-weight:700; color:#0f5132; white-space:nowrap">
            Rp {{ number_format($order->total, 0, ',', '.') }}
        </td>
        <td>
            @if($order->delivery === 'antar')
                <span style="font-size:12px">Diantar</span>
                @if($order->address)
                    <div style="font-size:11px; color:#888">{{ Str::limit($order->address, 30) }}</div>
                @endif
            @else
                <span style="font-size:12px">Jemput</span>
            @endif
        </td>
        <td style="font-size:12px; color:#888; white-space:nowrap">
            {{ $order->created_at->format('d M Y') }}<br>
            {{ $order->created_at->format('H:i') }}
        </td>
        <td>
            @if($order->status === 'pending')
                <span class="badge-pending">Pending</span>
            @else
                <span class="badge-diterima">Diterima</span>
            @endif
        </td>
        <td onclick="event.stopPropagation()">
            <div class="d-flex gap-2">
                @if($order->status === 'pending')
                    <form action="/admin/order/status/{{ $order->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="diterima">
                        <button type="submit" class="btn-green btn-order">
                            <i class="bi bi-check-lg"></i> Terima
                        </button>
                    </form>
                @else
                    <form action="/admin/order/status/{{ $order->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="pending">
                        <button type="submit" class="btn-yellow btn-order">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </form>
                @endif
                <form action="/admin/order/delete/{{ $order->id }}" method="POST"
                      onsubmit="return confirm('Hapus order ini?')">
                    @csrf
                    <button type="submit" class="btn-red btn-order">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@else
    <div class="text-center py-5 text-muted">
        <i class="bi bi-bag-x" style="font-size:48px; color:#ccc; display:block; margin-bottom:16px"></i>
        <p>Belum ada order.</p>
    </div>
@endif



<!-- ══ MODAL: DETAIL ORDER ══ -->
<div class="modal fade" id="modalDetailOrder" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-receipt me-2"></i>Detail Order <span id="detailOrderId" style="color:#888; font-weight:400"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="order-detail-row"><span style="color:#888">Nama Pemesan</span><span style="font-weight:600" id="detailNama"></span></div>
                        <div class="order-detail-row"><span style="color:#888">Tanggal Order</span><span id="detailTanggal"></span></div>
                        <div class="order-detail-row"><span style="color:#888">Status</span><span id="detailStatus"></span></div>
                    </div>
                    <div class="col-md-6">
                        <div class="order-detail-row"><span style="color:#888">Pengiriman</span><span id="detailDelivery"></span></div>
                        <div class="order-detail-row"><span style="color:#888">Alamat</span><span id="detailAlamat" style="max-width:200px; text-align:right"></span></div>
                        <div class="order-detail-row"><span style="color:#888">Catatan</span><span id="detailNotes" style="color:#888; font-size:13px"></span></div>
                    </div>
                </div>
                <div style="font-weight:700; color:#0f5132; margin-bottom:12px; font-size:15px">
                    <i class="bi bi-bag me-1"></i> Item Pesanan
                </div>
                <div id="detailItems"></div>
                <div style="background:#f0fdf4; border-radius:14px; padding:16px 20px; margin-top:16px; display:flex; justify-content:space-between; align-items:center">
                    <span style="font-weight:700; color:#0f5132; font-size:15px">Total Pembayaran</span>
                    <span style="font-weight:800; font-size:20px; color:#0f5132" id="detailTotal"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ══ MODAL: CATAT ORDER BARU ══ -->
<div class="modal fade" id="modalTambahOrder" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-bag-plus-fill me-2"></i>Catat Order Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/order/store" method="POST" id="orderForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Pemesan <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control" placeholder="Nama pelanggan..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" placeholder="628xxxxxxxxxx">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Pengiriman</label>
                            <select name="delivery" class="form-select" id="deliverySelect" onchange="toggleAddressField()">
                                <option value="antar">Diantar ke Alamat</option>
                                <option value="jemput">Jemput ke Store</option>
                            </select>
                        </div>
                        <div class="col-12" id="addressField">
                            <label class="form-label">Alamat Pengiriman</label>
                            <textarea name="address" class="form-control" placeholder="Alamat lengkap..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Catatan Tambahan</label>
                            <input type="text" name="notes" class="form-control" placeholder="Catatan untuk order ini...">
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <label class="form-label mb-0">Item Pesanan <span class="text-danger">*</span></label>
                        <button type="button" class="btn-outline-green" onclick="addItem()">
                            <i class="bi bi-plus-lg"></i> Tambah Item
                        </button>
                    </div>
                    <div id="itemList"></div>
                    <div class="mt-3 p-3" style="background:#f0fdf4; border-radius:12px">
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="font-weight:700; color:#0f5132">Total Pesanan</span>
                            <span style="font-weight:800; font-size:18px; color:#0f5132" id="grandTotal">Rp 0</span>
                        </div>
                    </div>
                    <input type="hidden" name="total" id="hiddenTotal" value="0">
                    <input type="hidden" name="items" id="hiddenItems" value="[]">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-green px-4" onclick="prepareSubmit(event)">
                        <i class="bi bi-save-fill me-1"></i> Simpan Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ══ MODAL: EDIT PRODUK ══ -->
<div class="modal fade" id="modalEditProduk" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-fill me-2"></i>Edit Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" id="editCategory" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" id="editDescription" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga Regular</label>
                            <input type="number" name="price_regular" id="editPriceRegular" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga Large</label>
                            <input type="number" name="price_large" id="editPriceLarge" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Foto Produk <span class="text-muted" style="font-weight:400">(kosongkan jika tidak diganti)</span></label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-green px-4">
                        <i class="bi bi-save-fill me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ══ MODAL: TAMBAH TESTIMONI ══ -->
<div class="modal fade" id="modalTambahTesti" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-chat-quote-fill me-2"></i>Tambah Testimoni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/testimonial/store" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Nama pelanggan..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role / Keterangan</label>
                            <input type="text" name="role" class="form-control" value="Pelanggan Setia" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Isi Testimoni <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control" placeholder="Tulis testimoni..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rating (1–5)</label>
                            <select name="rating" class="form-select" required>
                                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                <option value="4">⭐⭐⭐⭐ (4)</option>
                                <option value="3">⭐⭐⭐ (3)</option>
                                <option value="2">⭐⭐ (2)</option>
                                <option value="1">⭐ (1)</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="isActiveAdd" class="form-check-input" checked>
                                <label class="form-check-label" for="isActiveAdd" style="font-size:14px">Tampilkan di website</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-green px-4">
                        <i class="bi bi-save-fill me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ══ MODAL: EDIT TESTIMONI ══ -->
<div class="modal fade" id="modalEditTesti" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-fill me-2"></i>Edit Testimoni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editTestiForm" action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="editTestiName" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role / Keterangan</label>
                            <input type="text" name="role" id="editTestiRole" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Isi Testimoni <span class="text-danger">*</span></label>
                            <textarea name="content" id="editTestiContent" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rating (1–5)</label>
                            <select name="rating" id="editTestiRating" class="form-select" required>
                                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                <option value="4">⭐⭐⭐⭐ (4)</option>
                                <option value="3">⭐⭐⭐ (3)</option>
                                <option value="2">⭐⭐ (2)</option>
                                <option value="1">⭐ (1)</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="editTestiActive" class="form-check-input">
                                <label class="form-check-label" for="editTestiActive" style="font-size:14px">Tampilkan di website</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-green px-4">
                        <i class="bi bi-save-fill me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

/* ── FILTER ORDER ── */
document.querySelectorAll('.order-filter').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.order-filter').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        document.querySelectorAll('.order-row').forEach(row => {
            row.style.display = (filter === 'all' || row.dataset.status === filter) ? '' : 'none';
        });
    });
});

/* ── MODAL DETAIL ORDER ── */
function openOrderDetail(el) {
    const id       = el.dataset.id;
    const nama     = el.dataset.nama;
    const itemsRaw = el.dataset.items;
    const total    = parseInt(el.dataset.total);
    const delivery = el.dataset.delivery;
    const address  = el.dataset.address;
    const status   = el.dataset.statusVal;
    const notes    = el.dataset.notes;
    const tanggal  = el.dataset.tanggal;

    document.getElementById('detailOrderId').textContent = '#' + id;
    document.getElementById('detailNama').textContent    = nama;
    document.getElementById('detailTanggal').textContent = tanggal;
    document.getElementById('detailNotes').textContent   = notes || '-';
    document.getElementById('detailTotal').textContent   = 'Rp ' + total.toLocaleString('id-ID');

    document.getElementById('detailStatus').innerHTML = status === 'pending'
        ? '<span class="badge-pending">Pending</span>'
        : '<span class="badge-diterima">Diterima</span>';

    document.getElementById('detailDelivery').textContent =
        delivery === 'antar' ? '🛵 Diantar ke Alamat' : '🏪 Jemput ke Store';
    document.getElementById('detailAlamat').textContent =
        delivery === 'antar' ? (address || '-') : '-';

    let itemsEl = document.getElementById('detailItems');
    itemsEl.innerHTML = '';

    try {
        let parsed = JSON.parse(itemsRaw);
        if (Array.isArray(parsed)) {
            parsed.forEach(item => {
                let subtotal = (item.price || 0) * (item.qty || 1);
                itemsEl.innerHTML += `
                    <div class="order-item-line">
                        <div class="d-flex justify-content-between">
                            <span style="font-weight:600">${item.name || '-'}</span>
                            <span style="font-weight:700; color:#0f5132">Rp ${subtotal.toLocaleString('id-ID')}</span>
                        </div>
                        <div style="color:#888; font-size:12px; margin-top:2px">
                            Size: ${item.size || '-'} &nbsp;·&nbsp; Qty: ${item.qty || 1}
                            &nbsp;·&nbsp; @Rp ${(item.price || 0).toLocaleString('id-ID')}
                        </div>
                    </div>`;
            });
        }
    } catch(e) {
        itemsEl.innerHTML = '<div class="order-item-line">' + itemsRaw + '</div>';
    }

    new bootstrap.Modal(document.getElementById('modalDetailOrder')).show();
}
/* ── MODAL EDIT PRODUK ── */
function openEditModal(id, name, categoryId, description, priceRegular, priceLarge) {
    document.getElementById('editProductForm').action = '/admin/update/' + id;
    document.getElementById('editName').value         = name;
    document.getElementById('editCategory').value     = categoryId;
    document.getElementById('editDescription').value  = description;
    document.getElementById('editPriceRegular').value = priceRegular;
    document.getElementById('editPriceLarge').value   = priceLarge;
    new bootstrap.Modal(document.getElementById('modalEditProduk')).show();
}

/* ── MODAL EDIT TESTIMONI ── */
function openEditTesti(id, name, role, content, rating, isActive) {
    document.getElementById('editTestiForm').action    = '/admin/testimonial/update/' + id;
    document.getElementById('editTestiName').value     = name;
    document.getElementById('editTestiRole').value     = role;
    document.getElementById('editTestiContent').value  = content;
    document.getElementById('editTestiRating').value   = rating;
    document.getElementById('editTestiActive').checked = isActive === 1;
    new bootstrap.Modal(document.getElementById('modalEditTesti')).show();
}

/* ── FORM ORDER: ITEM DINAMIS ── */
let itemCount = 0;

function addItem() {
    itemCount++;
    const id = 'item_' + itemCount;
    document.getElementById('itemList').insertAdjacentHTML('beforeend', `
        <div class="item-row" id="${id}">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Nama Menu</label>
                    <input type="text" class="form-control item-name" placeholder="Contoh: Caramel Latte">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Size</label>
                    <select class="form-select item-size">
                        <option value="Regular">Regular</option>
                        <option value="Large">Large</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Qty</label>
                    <input type="number" class="form-control item-qty" value="1" min="1" oninput="calcTotal()">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga / item</label>
                    <input type="number" class="form-control item-price" placeholder="15000" oninput="calcTotal()">
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn-red" onclick="removeItem('${id}')" style="height:42px; width:42px; border-radius:10px;">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `);
    calcTotal();
}

function removeItem(id) { document.getElementById(id).remove(); calcTotal(); }

function calcTotal() {
    let total = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const qty   = parseInt(row.querySelector('.item-qty').value)   || 0;
        const price = parseInt(row.querySelector('.item-price').value) || 0;
        total += qty * price;
    });
    document.getElementById('grandTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('hiddenTotal').value      = total;
}

function prepareSubmit(e) {
    const rows = document.querySelectorAll('.item-row');
    if (rows.length === 0) { e.preventDefault(); alert('Tambahkan minimal 1 item pesanan!'); return; }
    let items = [], valid = true;
    rows.forEach(row => {
        const name  = row.querySelector('.item-name').value.trim();
        const size  = row.querySelector('.item-size').value;
        const qty   = parseInt(row.querySelector('.item-qty').value)   || 0;
        const price = parseInt(row.querySelector('.item-price').value) || 0;
        if (!name || qty < 1 || price < 1) { valid = false; return; }
        items.push({ name, size, qty, price });
    });
    if (!valid) { e.preventDefault(); alert('Lengkapi semua field item pesanan!'); return; }
    document.getElementById('hiddenItems').value = JSON.stringify(items);
}

function toggleAddressField() {
    const val = document.getElementById('deliverySelect').value;
    document.getElementById('addressField').style.display = val === 'jemput' ? 'none' : '';
}

document.getElementById('modalTambahOrder').addEventListener('hidden.bs.modal', function() {
    document.getElementById('itemList').innerHTML = '';
    document.getElementById('orderForm').reset();
    document.getElementById('grandTotal').textContent = 'Rp 0';
    document.getElementById('hiddenTotal').value = '0';
    itemCount = 0;
    toggleAddressField();
});

</script>
</body>
</html>