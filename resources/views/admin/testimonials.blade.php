<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Testimoni · SEMOGA DJAYA COFFEE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    * { font-family: 'Poppins', sans-serif; }
    body { background: #f4f4f4; min-height: 100vh; }

    .sidebar { width: 270px; background: #0f5132; min-height: 100vh; padding: 40px 25px; position: fixed; left: 0; top: 0; overflow-y: auto; }
    .sidebar h1 { color: white; font-size: 26px; font-weight: 900; margin-bottom: 40px; line-height: 1.3; }
    .sidebar a { display: flex; align-items: center; gap: 12px; color: white; text-decoration: none; padding: 13px 18px; border-radius: 14px; margin-bottom: 8px; font-size: 15px; font-weight: 500; transition: 0.25s; }
    .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.15); }
    .sidebar .nav-section { color: rgba(255,255,255,0.4); font-size: 10px; letter-spacing: 2px; text-transform: uppercase; margin: 24px 0 10px 18px; }

    .main { margin-left: 270px; padding: 40px 48px; }
    .page-title { font-size: 32px; font-weight: 800; color: #0f5132; margin-bottom: 4px; }
    .page-sub { color: #888; font-size: 14px; }

    .btn-green { background: #0f5132; color: white; border: none; border-radius: 10px; padding: 8px 18px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
    .btn-green:hover { background: #0b3d27; color: white; }
    .btn-red { background: #fee2e2; color: #b91c1c; border: none; border-radius: 10px; padding: 8px 14px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
    .btn-red:hover { background: #fecaca; }
    .btn-yellow { background: #fef9c3; color: #854d0e; border: none; border-radius: 10px; padding: 8px 14px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
    .btn-yellow:hover { background: #fef08a; }

    .alert-success { border-radius: 16px; border: none; background: #d1e7dd; color: #0a3622; }

    .testi-card { background: white; border-radius: 20px; padding: 24px; border: 1px solid #e5e5e5; box-shadow: 0 4px 16px rgba(0,0,0,0.04); height: 100%; }
    .testi-card .stars { color: #f5a623; font-size: 14px; letter-spacing: 1px; }
    .testi-card .testi-name { font-weight: 700; color: #0f5132; font-size: 16px; }
    .testi-card .testi-role { font-size: 12px; color: #888; }
    .testi-card .testi-content { font-size: 13px; color: #555; margin-top: 10px; font-style: italic; line-height: 1.8; }
    .status-pill { font-size: 11px; padding: 4px 12px; border-radius: 50px; font-weight: 600; white-space: nowrap; }
    .status-aktif { background: #d1e7dd; color: #0a3622; }
    .status-off { background: #f0f0f0; color: #888; }

    .modal-content { border: none; border-radius: 24px; }
    .modal-header { border-bottom: 1px solid #f0f0f0; padding: 24px 28px; }
    .modal-footer { border-top: 1px solid #f0f0f0; padding: 20px 28px; }
    .modal-body { padding: 28px; }
    .modal-title { font-weight: 800; color: #0f5132; font-size: 20px; }
    .form-label { font-weight: 600; font-size: 14px; color: #333; margin-bottom: 8px; }
    .form-control, .form-select { border-radius: 12px; border: 1.5px solid #e5e5e5; padding: 10px 16px; font-size: 14px; }
    .form-control:focus, .form-select:focus { border-color: #0f5132; box-shadow: none; }
    .form-check-input:checked { background-color: #0f5132; border-color: #0f5132; }
    textarea.form-control { min-height: 90px; }

    @media (max-width: 991px) { .sidebar { display: none; } .main { margin-left: 0; padding: 20px; } }
  </style>
</head>
<body>

<div class="sidebar">
  <h1>SEMOGA<br>DJAYA<br>COFFEE</h1>
  <div class="nav-section">Menu</div>
  <a href="/admin"><i class="bi bi-grid"></i> Dashboard</a>
  <a href="/admin/products"><i class="bi bi-cup-hot"></i> Produk</a>
  <a href="/admin/testimonials" class="active"><i class="bi bi-chat-quote"></i> Testimoni</a>
  <div class="nav-section">Lainnya</div>
  <a href="/" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Lihat Website</a>
</div>

<div class="main">

  @if(session('success'))
    <div class="alert alert-success mb-4">
      <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-start mb-2">
    <div>
      <div class="page-title">Testimoni</div>
      <div class="page-sub">Kelola ulasan pelanggan yang tampil di website</div>
    </div>
    <button type="button" class="btn-green" data-bs-toggle="modal" data-bs-target="#modalTambahTesti">
      <i class="bi bi-plus-lg"></i> Tambah Testimoni
    </button>
  </div>

  <p style="font-size:13px; color:#888; margin: 16px 0 24px;">
    <i class="bi bi-info-circle"></i>
    Maksimal 3 testimoni aktif yang ditampilkan di halaman utama website.
  </p>

  @if($testimonials->count() > 0)
    <div class="row g-3">
      @foreach($testimonials as $testi)
      <div class="col-md-6 col-xl-4">
        <div class="testi-card">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
              <div class="testi-name">{{ $testi->name }}</div>
              <div class="testi-role">{{ $testi->role }}</div>
              <div class="stars mt-1">
                @for($i = 1; $i <= 5; $i++)
                  <i class="bi {{ $i <= $testi->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                @endfor
              </div>
            </div>
            @if($testi->is_active)
              <span class="status-pill status-aktif"><i class="bi bi-check-circle"></i> Aktif</span>
            @else
              <span class="status-pill status-off"><i class="bi bi-x-circle"></i> Nonaktif</span>
            @endif
          </div>

          <div class="testi-content">"{{ $testi->content }}"</div>

          <div class="d-flex gap-2 mt-3">
            <button type="button" class="btn-yellow"
              data-id="{{ $testi->id }}"
              data-name="{{ $testi->name }}"
              data-role="{{ $testi->role }}"
              data-content="{{ $testi->content }}"
              data-rating="{{ $testi->rating }}"
              data-active="{{ $testi->is_active ? 1 : 0 }}"
              onclick="openEditTesti(this)">
              <i class="bi bi-pencil"></i> Edit
            </button>
            <form action="/admin/testimonial/delete/{{ $testi->id }}" method="POST"
                  onsubmit="return confirm('Hapus testimoni ini?')">
              @csrf
              <button type="submit" class="btn-red" title="Hapus"><i class="bi bi-trash"></i></button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  @else
    <div class="text-center py-5" style="background:white; border-radius:24px; color:#888;">
      <i class="bi bi-chat-quote" style="font-size:40px"></i>
      <p class="mt-2 mb-0">Belum ada testimoni.</p>
    </div>
  @endif
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahTesti" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Testimoni</h5>
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
                <option value="5">★★★★★ (5)</option>
                <option value="4">★★★★ (4)</option>
                <option value="3">★★★ (3)</option>
                <option value="2">★★ (2)</option>
                <option value="1">★ (1)</option>
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
          <button type="submit" class="btn-green"><i class="bi bi-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEditTesti" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Testimoni</h5>
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
                <option value="5">★★★★★ (5)</option>
                <option value="4">★★★★ (4)</option>
                <option value="3">★★★ (3)</option>
                <option value="2">★★ (2)</option>
                <option value="1">★ (1)</option>
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
          <button type="submit" class="btn-green"><i class="bi bi-save"></i> Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function openEditTesti(btn) {
    const d = btn.dataset;
    document.getElementById('editTestiForm').action = '/admin/testimonial/update/' + d.id;
    document.getElementById('editTestiName').value = d.name;
    document.getElementById('editTestiRole').value = d.role;
    document.getElementById('editTestiContent').value = d.content;
    document.getElementById('editTestiRating').value = d.rating;
    document.getElementById('editTestiActive').checked = d.active === '1';
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditTesti')).show();
  }
</script>
</body>
</html>