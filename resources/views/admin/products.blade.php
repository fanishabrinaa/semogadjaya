<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk ¢ SEMOGA DJAYA COFFEE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
    body { background: #f4f4f4; min-height: 100vh; display: flex; }
    .sidebar { width: 270px; background: #0f5132; min-height: 100vh; padding: 40px 25px; position: fixed; left: 0; top: 0; overflow-y: auto; }
    .sidebar h1 { color: white; font-size: 26px; font-weight: 900; margin-bottom: 40px; line-height: 1.3; }
    .sidebar a { display: flex; align-items: center; gap: 12px; color: white; text-decoration: none; padding: 13px 18px; border-radius: 14px; margin-bottom: 8px; font-size: 15px; font-weight: 500; transition: 0.25s; }
    .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.15); }
    .sidebar .nav-section { color: rgba(255,255,255,0.4); font-size: 10px; letter-spacing: 2px; text-transform: uppercase; margin: 24px 0 10px 18px; }
    .main { margin-left: 270px; width: calc(100% - 270px); padding: 40px 48px; }
    .page-title { font-size: 32px; font-weight: 800; color: #0f5132; margin-bottom: 4px; }
    .page-sub { color: #888; font-size: 14px; margin-bottom: 32px; }
    .table-card { background: white; border-radius: 24px; padding: 28px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    .table th { font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: #888; font-weight: 600; border-bottom: 2px solid #f0f0f0; padding: 12px 16px; }
    .table td { padding: 14px 16px; vertical-align: middle; font-size: 14px; border-bottom: 1px solid #f8f8f8; }
    .table tr:last-child td { border-bottom: none; }
    .product-img { width: 52px; height: 52px; object-fit: cover; border-radius: 12px; }
    .btn-green { background: #0f5132; color: white; border: none; border-radius: 10px; padding: 8px 18px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .btn-green:hover { background: #0b3d27; color: white; }
    .btn-red { background: #fee2e2; color: #b91c1c; border: none; border-radius: 10px; padding: 8px 14px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
    .btn-red:hover { background: #fecaca; }
    .btn-yellow { background: #fef9c3; color: #854d0e; border: none; border-radius: 10px; padding: 8px 14px; font-size: 13px; font-weight: 600; transition: 0.2s; cursor: pointer; }
    .btn-yellow:hover { background: #fef08a; }
    .alert-success { border-radius: 16px; border: none; background: #d1e7dd; color: #0a3622; }
    .modal-content { border: none; border-radius: 24px; }
    .modal-header { border-bottom: 1px solid #f0f0f0; padding: 24px 28px; }
    .modal-footer { border-top: 1px solid #f0f0f0; padding: 20px 28px; }
    .modal-body { padding: 28px; }
    .modal-title { font-weight: 800; color: #0f5132; font-size: 20px; }
    .form-label { font-weight: 600; font-size: 14px; color: #333; margin-bottom: 8px; }
    .form-control, .form-select { border-radius: 12px; border: 1.5px solid #e5e5e5; padding: 10px 16px; font-size: 14px; }
    .form-control:focus, .form-select:focus { border-color: #0f5132; box-shadow: none; }
    textarea.form-control { min-height: 90px; }
    @media(max-width: 991px) { .sidebar { display: none; } .main { margin-left: 0; width: 100%; padding: 20px; } }
  </style>
</head>
<body>

<div class="sidebar">
  <h1>SEMOGA<br>DJAYA<br>COFFEE</h1>
  <div class="nav-section">Menu</div>
  <a href="/admin"> Dashboard</a>
  <a href="/admin/products" class="active"> Produk</a>
  <a href="/admin/testimonials"> Testimoni</a>
  <div class="nav-section">Lainnya</div>
  <a href="/" target="_blank"> Lihat Website</a>
</div>

<div class="main">

  @if(session('success'))
    <div class="alert alert-success mb-4">
       {{ session('success') }}
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-start mb-4">
    <div>
      <div class="page-title">Manajemen Produk</div>
      <div class="page-sub">Kelola semua menu kopi yang tersedia</div>
    </div>
    <a href="/admin/create" class="btn-green">
       Tambah Produk
    </a>
  </div>

  <div class="table-card">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nama</th>
          <th>Kategori</th>
          <th>Harga Regular</th>
          <th>Harga Large</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td><img src="{{ asset('products/' . $product->image) }}" class="product-img" alt="{{ $product->name }}"></td>
          <td>
            <div style="font-weight:600">{{ $product->name }}</div>
            <div style="font-size:12px; color:#888">{{ Str::limit($product->description, 40) }}</div>
          </td>
          <td style="font-size:13px">{{ $product->getRelation('category')?->name ?? '-' }}</td>
          <td style="font-weight:600; color:#0f5132">Rp {{ number_format($product->price_regular, 0, ',', '.') }}</td>
          <td style="font-weight:600; color:#0f5132">Rp {{ number_format($product->price_large, 0, ',', '.') }}</td>
          <td>
            <div class="d-flex gap-2">
              <button class="btn-yellow"
                onclick="openEditModal(
                  {{ $product->id }},
                  '{{ addslashes($product->name) }}',
                  '{{ $product->category_id }}',
                  '{{ addslashes($product->description) }}',
                  '{{ $product->price_regular }}',
                  '{{ $product->price_large }}'
                )">
                 Edit
              </button>
              <form action="/admin/delete/{{ $product->id }}" method="POST"
                 onsubmit="return confirm('Yakin hapus produk ini?')">
                @csrf
                <button type="submit" class="btn-red">
                  
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</div>


<div class="modal fade" id="modalEditProduk" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Produk</h5>
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
          <button type="submit" class="btn-green">
             Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function openEditModal(id, name, categoryId, description, priceRegular, priceLarge) {
  document.getElementById('editProductForm').action = '/admin/update/' + id;
  document.getElementById('editName').value     = name;
  document.getElementById('editCategory').value   = categoryId;
  document.getElementById('editDescription').value = description;
  document.getElementById('editPriceRegular').value = priceRegular;
  document.getElementById('editPriceLarge').value  = priceLarge;
  new bootstrap.Modal(document.getElementById('modalEditProduk')).show();
}
</script>
</body>
</html>
