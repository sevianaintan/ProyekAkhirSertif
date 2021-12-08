<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Local Brand Skincare</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .section-space {
      padding-top: 80px;
      padding-bottom: 80px;
    }
    #hero {
      background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url("img/skinker.jpg") no-repeat;
      background-size: cover;
      height: 100vh;
    }
    #hero p {
      line-height: 1.5rem;
    }
    #skin-care h2 {
      margin-bottom: 4rem;
    }
    #form-tambah {
      background-color: #B4C6A6;
    }
    #form-tambah .subheading {
      font-size: 20px;
    }
    footer {
      padding-top: 5px;
      padding-bottom: 5px;
    }
    #deskripsi-count {
      margin-top: 2px;
    }
  </style>
</head>
<body>
  @if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
  @endif
  <section id="hero">
    <div class="container h-100">
      <div class="h-100 align-items-center row">
        <div class="col-12 col-md-6" >
          <iframe width="560" height="315" src="https://www.youtube.com/embed/bEKyvytJv0o" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="text-white col-12 col-md-6">
          <h1 class="display-3 fw-bold">Local Brand SkinCare</h1>
          <p>Ingin memiliki kulit yang sehat dan cantik? Jangan lupa untuk memakai produk perawatan kulit secara rutin. Dengan penggunaan perawatan yang rutin dapat mencegah maupun mengatasi segala jenis permasalahan kulit anda loh!</p>
        </div>
      </div>
    </div>
  </section>
  <section id="skin-care" class="section-space">
    <div class="container">
      <h2 class="text-center">Daftar Local Brand Scincare </h2>
      @if (count($skin_care) > 0)
      <div class="row g-3">
        @foreach ($skin_care as $skin)
        <div class="col-lg-3 col-md-4 col-12">
          <div class="card h-100">
            <img src="{{$skin->gambar}}" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">{{$skin->nama}}</h5>
              <h6 class="mb-2 card-subtitle text-muted">{{$skin->brand}}</h6>
              <p class="card-text">{{$skin->deskripsi}}</p>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-6">
                  <!-- tombol hapus Produk -->
                  <form action="{{ route('hapus.skin.care', $skin->id),  }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Hapus</button>
                  </form>
                </div>
                <div class="col-6">
                  <!-- tombol update Produk -->
                  <button data-bs-toggle="modal" data-bs-target="#editSkinCare" class="btn btn-warning w-100" onclick="updateEditMakananForm('{{ $skin->id }}', '{{ $skin->nama }}', '{{ $skin->brand }}', '{{ $skin->deskripsi }}')">Edit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @else
      <p class="text-center text-muted">Belum ada produk yang terdaftar</p>
      @endif
    </div>
  </section>
  <section id="form-tambah" class="section-space">
    <div class="container">
      <p class="text-center subheading">Produk Favoritmu Belum Masuk Daftar?</p>
      <h2 class="text-center">Tambahkan Produk Favoritmu</h2>
      <form action="{{ route('tambah.skin.care') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="nama-skin-care" class="form-label">Nama Produk</label>
          <input type="text" class="form-control" id="nama-skin-care" name="nama" required>
        </div>
        <div class="mb-3">
          <label for="brand-skin-care" class="form-label">Brand</label>
          <input type="text" class="form-control" id="brand-skin-care" name="brand" required>
        </div>
        <div class="mb-3">
          <label for="deskripsi-skin-care" class="form-label">Deskripsi Singkat</label>
          <textarea type="text" class="form-control" id="deskripsi-skin-care" name="deskripsi" maxlength="254" rows="4" required></textarea>
          <span id="deskripsi-count">0 / 254</span>
        </div>
        <div class="mb-3">
          <label for="gambar-skin-care" class="form-label">Foto Produk</label>
          <input class="form-control" type="file" name="gambar" id="gambar-skin-care" required>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </section>

  <!-- Modal edit Produk -->
  <div class="modal fade" id="editSkinCare" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSkinCareLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editSkinCareLabel">Edit Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formUpdateMakanan" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="update-nama-skin-care" class="form-label">Nama Produk</label>
              <input type="text" class="form-control" id="update-nama-skin-care" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="update-brand-skin-care" class="form-label">Brand</label>
              <input type="text" class="form-control" id="update-brand-skin-care" name="brand" required>
            </div>
            <div class="mb-3">
              <label for="update-deskripsi-skin-care" class="form-label">Deskripsi Singkat</label>
              <textarea type="text" class="form-control" id="update-deskripsi-skin-care" name="deskripsi" maxlength="254" rows="4" required></textarea>
              <span id="update-deskripsi-count">0 / 254</span>
            </div>
            <div class="mb-3">
              <label for="update-gambar-skin-care" class="form-label">Foto Produk</label>
              <input class="form-control" type="file" name="gambar" id="update-gambar-skin-care">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Script Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Script custom -->
  <script src="js/main.js"></script>
</body>
</html>