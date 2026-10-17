<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk ¢ SEMOGA DJAYA COFFEE</title>

  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>

    *{
      font-family:'Poppins', sans-serif;
    }

    body{
      background:#f4f4f4;
      min-height:100vh;
      display:flex;
    }

    

    .sidebar{
      width:270px;
      background:#0f5132;
      min-height:100vh;
      padding:40px 25px;
      position:fixed;
      left:0;
      top:0;
    }

    .sidebar h1{
      color:white;
      font-size:32px;
      font-weight:900;
      margin-bottom:60px;
      line-height:1.3;
    }

    .sidebar a{
      display:block;
      color:white;
      text-decoration:none;
      padding:14px 18px;
      border-radius:18px;
      margin-bottom:18px;
      font-size:18px;
      font-weight:500;
      transition:0.3s;
    }

    .sidebar a:hover{
      background:rgba(255,255,255,0.12);
    }

    

    .main{
      margin-left:270px;
      width:100%;
      padding:60px;
    }

    .card-form{
      background:white;
      border-radius:35px;
      padding:55px;
      box-shadow:0 10px 35px rgba(0,0,0,0.06);
      max-width:850px;
      margin:auto;
    }

    .title{
      font-size:55px;
      font-weight:900;
      color:#0f5132;
      margin-bottom:10px;
    }

    .subtitle{
      color:#777;
      font-size:18px;
      margin-bottom:40px;
    }

    

    .form-label{
      font-weight:600;
      margin-bottom:12px;
      color:#222;
    }

    .form-control,
    .form-select{
      border-radius:18px;
      border:1px solid #ddd;
      height:60px;
      padding-left:20px;
      font-size:16px;
      box-shadow:none !important;
    }

    textarea.form-control{
      height:160px !important;
      padding-top:15px;
    }

    .form-control:focus,
    .form-select:focus{
      border-color:#0f5132;
    }

    

    .file-upload{
      border:2px dashed #0f5132;
      border-radius:20px;
      padding:40px 20px;
      text-align:center;
      background:#f9fffc;
      transition:0.3s;
    }

    .file-upload:hover{
      background:#eefaf4;
    }

    .file-upload i{
      font-size:55px;
      color:#0f5132;
      margin-bottom:15px;
    }

    .file-upload p{
      color:#666;
      margin-top:10px;
    }

    .file-upload input{
      margin-top:20px;
    }

    

    .btn-premium{
      width:100%;
      height:60px;
      border:none;
      border-radius:18px;
      background:#0f5132;
      color:white;
      font-size:18px;
      font-weight:700;
      transition:0.3s;
    }

    .btn-premium:hover{
      background:#0b3d27;
      transform:translateY(-2px);
    }

    

    .top-bar{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:40px;
      gap:20px;
    }

    .back-btn{
      text-decoration:none;
      background:white;
      padding:14px 24px;
      border-radius:50px;
      color:#0f5132;
      font-weight:600;
      box-shadow:0 5px 20px rgba(0,0,0,0.05);
      transition:0.3s;
    }

    .back-btn:hover{
      transform:translateY(-2px);
      color:#0f5132;
    }

    .alert-danger{
      border-radius:18px;
    }

    

    @media(max-width:991px){

      .sidebar{
        display:none;
      }

      .main{
        margin-left:0;
        padding:25px;
      }

      .card-form{
        padding:35px 25px;
      }

      .title{
        font-size:38px;
      }

      .top-bar{
        flex-direction:column;
        align-items:flex-start;
      }

    }

  </style>

</head>
<body>



<div class="sidebar">

  <h1>SEMOGA DJAYA COFFEE</h1>

  <a href="/admin">
    
    Dashboard
  </a>

  <a href="/admin/create">
    
    Tambah Produk
  </a>

  <a href="/">
    
    Lihat Website
  </a>

</div>



<div class="main">

  <div class="top-bar">

    <div>

      <h1 class="title">
        Tambah Produk
      </h1>

      <p class="subtitle">
        Tambahkan menu coffee premium baru
      </p>

    </div>

    <a href="/admin" class="back-btn">
      Kembali
    </a>

  </div>

  

  @if ($errors->any())

    <div class="alert alert-danger mb-4">

      <ul class="mb-0">

        @foreach ($errors->all() as $error)

          <li>{{ $error }}</li>

        @endforeach

      </ul>

    </div>

  @endif

  

  <div class="card-form">

    <form action="/admin/store" method="POST" enctype="multipart/form-data">

      @csrf

      

      <div class="mb-4">

        <label class="form-label">
          Nama Produk
        </label>

        <input 
          type="text" 
          name="name" 
          class="form-control"
          placeholder="Contoh: Caramel Latte"
          required
        >

      </div>

      

      <div class="mb-4">

        <label class="form-label">
          Kategori
        </label>

        <select
  name="category_id"
  class="form-select"
  required
>

  <option value="">
    -- Pilih Kategori --
  </option>

  @foreach($categories as $category)

    <option value="{{ $category->id }}">

      {{ $category->name }}

    </option>

  @endforeach

</select>

      </div>

      

      <div class="mb-4">

        <label class="form-label">
          Deskripsi Produk
        </label>

        <textarea 
          name="description" 
          class="form-control"
          placeholder="Deskripsi kopi..."
          required
        ></textarea>

      </div>

      

      <div class="mb-4">

        <label class="form-label">
          Harga Reguler
        </label>

        <input 
          type="number" 
          name="price_regular" 
          class="form-control"
          placeholder="Contoh: 13000"
          min="0"
          required
        >

      </div>

      

      <div class="mb-4">

        <label class="form-label">
          Harga Large
        </label>

        <input 
          type="number" 
          name="price_large" 
          class="form-control"
          placeholder="Contoh: 16000"
          min="0"
          required
        >

      </div>
      
      

      <div class="mb-5">

        <label class="form-label">
          Upload Foto Produk
        </label>

        <div class="file-upload">

          

          <h4 class="fw-bold">
            Upload Gambar Produk
          </h4>

          <p>
            Pilih foto kopi aesthetic terbaik
          </p>

          <input 
            type="file" 
            name="image" 
            class="form-control"
            accept="image/*"
            required
          >

        </div>

      </div>

      

      <button type="submit" class="btn-premium">

        

        Simpan Produk

      </button>

    </form>

  </div>

</div>

</body>
</html>
