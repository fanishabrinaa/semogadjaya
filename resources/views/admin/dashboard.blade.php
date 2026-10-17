<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard · SEMOGA DJAYA COFFEE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    * { font-family: 'Poppins', sans-serif; }
    body { background: #f4f4f4; min-height: 100vh; }

    /* Sidebar */
    .sidebar { width: 270px; background: #0f5132; min-height: 100vh; padding: 40px 25px; position: fixed; left: 0; top: 0; overflow-y: auto; }
    .sidebar h1 { color: white; font-size: 26px; font-weight: 900; margin-bottom: 40px; line-height: 1.3; }
    .sidebar a { display: flex; align-items: center; gap: 12px; color: white; text-decoration: none; padding: 13px 18px; border-radius: 14px; margin-bottom: 8px; font-size: 15px; font-weight: 500; transition: 0.25s; }
    .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.15); }
    .sidebar .nav-section { color: rgba(255,255,255,0.4); font-size: 10px; letter-spacing: 2px; text-transform: uppercase; margin: 24px 0 10px 18px; }

    /* Main */
    .main { margin-left: 270px; padding: 40px 48px; }

    /* Stat card */
    .stat-card { background: white; border-radius: 24px; padding: 28px 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    .stat-card .num { font-size: 36px; font-weight: 800; color: #0f5132; }
    .stat-card .lbl { font-size: 13px; color: #888; margin-top: 4px; }
    .stat-card .icon-wrap { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; color: #0f5132; }

    .section-title { font-size: 22px; font-weight: 800; color: #0f5132; }

    /* Table */
    .table-card { background: white; border-radius: 24px; padding: 28px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    .table th { font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: #888; font-weight: 600; border-bottom: 2px solid #f0f0f0; padding: 12px 16px; }
    .table td { padding: 14px 16px; vertical-align: middle; font-size: 14px; border-bottom: 1px solid #f8f8f8; }
    .table tr:last-child td { border-bottom: none; }

    /* Badge */
    .badge-pending { background: #fff3cd; color: #856404; padding: 5px 14px; border-radius: 50px; font-size: 12px; font-weight: 600; }
    .badge-diterima { background: #d1e7dd; color: #0a3622; padding: 5px 14px; border-radius: 50px; font-size: 12px; font-weight: 600; }

    /* Buttons */
    .btn-green { background: #0f5132; color: white; border: none; border-radius: 10px; padding: 8px 18px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
    .btn-green:hover { background: #0b3d27; color: white; }
    .btn-red { background: #fee2e2; color: #b91c1c; border: none; border-radius: 10px; padding: 8px 14px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
    .btn-red:hover { background: #fecaca; }
    .btn-yellow { background: #fef9c3; color: #854d0e; border: none; border-radius: 10px; padding: 8px 14px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
    .btn-yellow:hover { background: #fef08a; }
    .btn-outline-green { background: transparent; border: 1.5px solid #0f5132; color: #0f5132; border-radius: 10px; padding: 7px 16px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
    .btn-outline-green:hover, .btn-outline-green.active { background: #0f5132; color: white; }
    .btn-order { padding: 6px 10px !important; font-size: 12px !important; border-radius: 8px; display: inline-flex; align-items: center; gap: 5px; white-space: nowrap; }

    /* Modal & form */
    .modal-content { border: none; border-radius: 24px; }
    .modal-header { border-bottom: 1px solid #f0f0f0; padding: 24px 28px; }
    .modal-footer { border-top: 1px solid #f0f0f0; padding: 20px 28px; }
    .modal-body { padding: 28px; }
    .modal-title { font-weight: 800; color: #0f5132; font-size: 20px; }
    .form-label { font-weight: 600; font-size: 14px; color: #333; margin-bottom: 8px; }
    .form-control, .form-select { border-radius: 12px; border: 1.5px solid #e5e5e5; padding: 10px 16px; font-size: 14px; }
    .form-control:focus, .form-select:focus { border-color: #0f5132; box-shadow: none; }
    textarea.form-control { min-height: 90px; }

    .alert-success { border-radius: 16px; border: none; background: #d1e7dd; color: #0a3622; }

    .nav-tabs { border-bottom: 2px solid #f0f0f0; margin-bottom: 24px; }
    .nav-tabs .nav-link { border: none; color: #888; font-weight: 600; font-size: 14px; padding: 10px 20px; border-radius: 0; }
    .nav-tabs .nav-link.active { color: #0f5132; border-bottom: 2px solid #0f5132; background: transparent; }

    .order-detail-row { display: flex; justify-content: space-between; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
    .order-detail-row:last-child { border-bottom: none; }
    .order-item-line { background: #f8f9fa; border-radius: 10px; padding: 10px 14px; margin-bottom: 8px; font-size: 13px; }

    .order-row-clickable { cursor: pointer; transition: background 0.2s; }
    .order-row-clickable:hover { background: #f0fdf4 !important; }

    .item-row { background: #f8f8f8; border-radius: 14px; border: 1px solid #eee; padding: 16px; margin-bottom: 10px; }

    @media (max-width: 991px) {
      .sidebar { display: none; }
      .main { margin-left: 0; padding: 20px; }
    }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h1>SEMOGA<br>DJAYA<br>COFFEE</h1>
  <div class="nav-section">Menu</div>
  <a href="/admin" class="active"><i class="bi bi-grid"></i> Dashboard</a>
  <a href="/admin/products"><i class="bi bi-cup-hot"></i> Produk</a>
  <a href="/admin/testimonials"><i class="bi bi-chat-quote"></i> Testimoni</a>
  <div class="nav-section">Lainnya</div>
  <a href="/" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Lihat Website</a>
</div>

<!-- MAIN -->
<div class="main">

  @if(session('success'))
    <div class="alert alert-success mb-4">
      <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <!-- STAT -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
      <div class="stat-card d-flex justify-content-between align-items-center">
        <div>
          <div class="num">{{ $products->count() }}</div>
          <div class="lbl">Total Produk</div>
        </div>
        <div class="icon-wrap" style="background:#e8f5ee"><i class="bi bi-cup-hot"></i></div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card d-flex justify-content-between align-items-center">
        <div>
          <div class="num">{{ $totalPending }}</div>
          <div class="lbl">Order Pending</div>
        </div>
        <div class="icon-wrap" style="background:#fff3cd"><i class="bi bi-hourglass-split"></i></div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card d-flex justify-content-between align-items-center">
        <div>
          <div class="num">{{ $totalDiterima }}</div>
          <div class="lbl">Order Diterima</div>
        </div>
        <div class="icon-wrap" style="background:#d1e7dd"><i class="bi bi-check2-circle"></i></div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card d-flex justify-content-between align-items-center">
        <div>
          <div class="num" style="font-size:22px">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
          <div class="lbl">Total Pendapatan</div>
        </div>
        <div class="icon-wrap" style="background:#dcfce7"><i class="bi bi-cash-stack"></i></div>
      </div>
    </div>
  </div>

  <!-- TABS -->
  <ul class="nav nav-tabs" id="dashTab">
    <li class="nav-item">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-order" type="button">
        <i class="bi bi-receipt"></i> Order
        @if($totalPending > 0)
          <span class="badge bg-danger ms-1" style="font-size:10px">{{ $totalPending }}</span>
        @endif
      </button>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="tab-order">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="section-title">Daftar Order</div>
      </div>

      <div class="d-flex gap-2 mb-3 flex-wrap">
        <button type="button" class="btn-outline-green order-filter active" data-filter="all">Semua ({{ $orders->count() }})</button>
        <button type="button" class="btn-outline-green order-filter" data-filter="pending">Pending ({{ $totalPending }})</button>
        <button type="button" class="btn-outline-green order-filter" data-filter="diterima">Diterima ({{ $totalDiterima }})</button>
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
                  data-items="{{ $order->items }}"
                  data-total="{{ $order->total }}"
                  data-delivery="{{ $order->delivery }}"
                  data-address="{{ $order->address ?? '' }}"
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
                    <span style="font-size:12px"><i class="bi bi-truck"></i> Diantar</span>
                    @if($order->address)
                      <div style="font-size:11px; color:#888">{{ Str::limit($order->address, 30) }}</div>
                    @endif
                  @else
                    <span style="font-size:12px"><i class="bi bi-shop"></i> Jemput</span>
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
                  <div class="d-flex align-items-center gap-2">
                    <form action="/admin/order/status/{{ $order->id }}" method="POST">
                      @csrf
                      @if($order->status === 'pending')
                        <input type="hidden" name="status" value="diterima">
                        <button type="submit" class="btn-green btn-order"><i class="bi bi-check-lg"></i> Terima</button>
                      @else
                        <input type="hidden" name="status" value="pending">
                        <button type="submit" class="btn-yellow btn-order" title="Kembalikan ke pending"><i class="bi bi-arrow-counterclockwise"></i></button>
                      @endif
                    </form>
                    <form action="/admin/order/delete/{{ $order->id }}" method="POST"
                          onsubmit="return confirm('Hapus order ini?')">
                      @csrf
                      <button type="submit" class="btn-red btn-order" title="Hapus"><i class="bi bi-trash"></i></button>
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
            <i class="bi bi-inbox" style="font-size:40px"></i>
            <p class="mt-2 mb-0">Belum ada order.</p>
          </div>
        @endif
      </div>

    </div><!-- /tab-order -->
  </div><!-- /tab-content -->
</div><!-- /main -->


<!-- MODAL DETAIL ORDER -->
<div class="modal fade" id="modalDetailOrder" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Order <span id="detailOrderId" style="color:#888; font-weight:400"></span></h5>
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
          <i class="bi bi-bag"></i> Item Pesanan
        </div>
        <div id="detailItems"></div>
        <div style="background:#f0fdf4; border-radius:14px; padding:16px 20px; margin-top:16px; display:flex; justify-content:space-between; align-items:center">
          <span style="font-weight:700; color:#0f5132">Total</span>
          <span style="font-weight:800; font-size:20px; color:#0f5132" id="detailTotal"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Escape HTML supaya aman dari XSS saat render lewat innerHTML
  function esc(str) {
    const d = document.createElement('div');
    d.textContent = str ?? '';
    return d.innerHTML;
  }

  // Filter order
  document.querySelectorAll('.order-filter').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.order-filter').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      const filter = this.dataset.filter;
      document.querySelectorAll('.order-row').forEach(row => {
        row.style.display = (filter === 'all' || row.dataset.status === filter) ? '' : 'none';
      });
    });
  });

  // Detail order
  function openOrderDetail(el) {
    const d = el.dataset;
    const total = parseInt(d.total) || 0;

    document.getElementById('detailOrderId').textContent = '#' + d.id;
    document.getElementById('detailNama').textContent = d.nama;
    document.getElementById('detailTanggal').textContent = d.tanggal;
    document.getElementById('detailNotes').textContent = d.notes || '-';
    document.getElementById('detailTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('detailStatus').innerHTML = d.status === 'pending'
      ? '<span class="badge-pending">Pending</span>'
      : '<span class="badge-diterima">Diterima</span>';
    document.getElementById('detailDelivery').textContent =
      d.delivery === 'antar' ? 'Diantar ke Alamat' : 'Jemput ke Store';
    document.getElementById('detailAlamat').textContent =
      d.delivery === 'antar' ? (d.address || '-') : '-';

    const itemsEl = document.getElementById('detailItems');
    itemsEl.innerHTML = '';

    try {
      const parsed = JSON.parse(d.items);
      if (!Array.isArray(parsed)) throw new Error('not array');
      parsed.forEach(item => {
        const price = item.price || 0;
        const qty = item.qty || 1;
        itemsEl.insertAdjacentHTML('beforeend', `
          <div class="order-item-line">
            <div class="d-flex justify-content-between">
              <span style="font-weight:600">${esc(item.name || '-')}</span>
              <span style="font-weight:700; color:#0f5132">Rp ${(price * qty).toLocaleString('id-ID')}</span>
            </div>
            <div style="color:#888; font-size:12px; margin-top:2px">
              Size: ${esc(item.size || '-')} &nbsp;·&nbsp; Qty: ${qty}
              &nbsp;·&nbsp; @Rp ${price.toLocaleString('id-ID')}
            </div>
          </div>`);
      });
    } catch (e) {
      itemsEl.innerHTML = '<div class="order-item-line">' + esc(d.items) + '</div>';
    }

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalDetailOrder')).show();
  }

</script>
</body>
</html>